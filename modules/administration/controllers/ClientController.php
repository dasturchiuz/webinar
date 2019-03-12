<?php

namespace app\modules\administration\controllers;
use Yii;
use app\models\Profile;
use app\models\ProfileSearch;
use yii\filters\AccessControl;
use yii\db\Query;
use yii\data\ActiveDataProvider;
use app\models\CommentProfile;
use app\models\Adresses;
class ClientController extends \yii\web\Controller
{
    public function behaviors(){
        return [
            'access'=>[
                'class'=>AccessControl::className(),
                'rules'=>[
                    [
                        'allow'=>true,
                        'actions'=>['messages', 'readmessages'],
                        'roles'=>['super_admin'],
                    ],
                    [
                        'allow'=>true,
                        'roles'=>['super_admin', 'admin', 'regional_managers', 'manager', 'agent', 'сouriers'],
                    ],
                    [
                        'allow'=>true,
                        'actions'=>['index', 'client-info', 'edit'],
                        'roles'=>['buxgalter'],
                    ],


                ],
            ],
        ];
    }


    public function actionIndex()
    {
        $searchModel = new ProfileSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, 'client');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    //yur litsoni tahrirlash
    public function actionEdit($profile_id){

        $model =Profile::findOne($profile_id);
        if(!Yii::$app->user->can('super_admin')){
            if(!( Yii::$app->user->can('IsRegion', ['profile'=>$model]))){
                Yii::$app->session->setFlash('error', "Этом клент не ваш регион");

                return $this->redirect(['/administration/client']);
            }
        }

        $modelAdress=Adresses::find()->where(['profile_id'=>$model->user_id])->one();
        if(empty($model)){
            Yii::$app->session->setFlash('error', 'ID не существует: ');
            return $this->redirect(['index']);
        }
        if ($model->load(Yii::$app->request->post()) && $modelAdress->load(Yii::$app->request->post())) {
//            echo "<pre>";
//            var_dump($modelJuridical);
//            die();
//
            $userAction=\app\models\config\UserActions::editProfile($model,$modelAdress);
            if(!$userAction){
                Yii::$app->session->setFlash('error', "Пользователь Не сахранен ");
                return $this->redirect(['client-info', 'id' => $model->user_id]);
            }
            Yii::$app->session->setFlash('success', "Пользователь успешно обновлено");
            return $this->redirect(['client-info', 'id' => $model->user_id]);
        }
        return $this->render('edit', [
            'model' => $model,
            'modelAdress' => $modelAdress,
        ]);

    }


    public function actionBlackList($profile_id){
        $model =Profile::findOne($profile_id);
        if(!( Yii::$app->user->can('IsRegion', ['profile'=>$model]) ||  !Yii::$app->user->can('super_admin'))){
            Yii::$app->session->setFlash('error', "Этом клент не ваш регион");

            return $this->redirect(['/administration/client']);
        }
        if(\app\models\config\UserActions::setBlock($profile_id))
        {
            Yii::$app->session->setFlash('success', 'Клиент поставлен в чёрный список');
            return $this->redirect(Yii::$app->request->referrer);
        }else{
            Yii::$app->session->setFlash('error', 'Ошибка! Причина уже в список или не сущ');
            return $this->redirect(Yii::$app->request->referrer);
        }
    }

    //foydalanuvchini yozishmalari
    public function actionMessages($user_id){
        return $this->render('messages', compact('user_id'));
    }

    //foydalanuvchini yozishmalarini o';qish
    public function actionReadmessages($chat_room, $id, $user_id){
        return $this->render('readmessages', compact('user_id', 'chat_room', 'id'));
    }


    public function actionUnBlackList($profile_id){
        $model =Profile::findOne($profile_id);
        if(!( Yii::$app->user->can('IsRegion', ['profile'=>$model]) ||  !Yii::$app->user->can('super_admin'))){
            Yii::$app->session->setFlash('error', "Этом клент не ваш регион");

            return $this->redirect(['/administration/client']);
        }
        if(\app\models\config\UserActions::unBlock($profile_id))
        {
            Yii::$app->session->setFlash('success', 'Клиент разблокирован в чёрный список');
            return $this->redirect(Yii::$app->request->referrer);
        }else{
            Yii::$app->session->setFlash('error', 'Ошибка! Причина уже в список или не сущ');
            return $this->redirect(Yii::$app->request->referrer);
        }
    }

    
    //klent ma'lumotlarini ko'rish
    public function actionClientInfo($id){
        $model=Profile::findOne($id);
        if(!Yii::$app->user->can('super_admin')){
            if(!( Yii::$app->user->can('IsRegion', ['profile'=>$model]))){
                Yii::$app->session->setFlash('error', "Этом клент не ваш регион");

                return $this->redirect(['/administration/client']);
            }
        }
        return $this->render('info', compact('model'));
    }
    //comentlarni ko'rish
    public function actionCommentProfile($profile_id){
        $model=Profile::findOne($profile_id);
        if(!Yii::$app->user->can('super_admin')){
            if(!Yii::$app->user->can('IsRegion', ['profile'=>$model])){
                Yii::$app->session->setFlash('error', "Этом клент не ваш регион");

                return $this->redirect(['/administration/client']);
            }
        }
        $comments=new ActiveDataProvider([
            'query'=>\app\models\CommentProfile::find()->where(['profile_id'=>$profile_id]),
            'sort'=> ['defaultOrder' => ['created_at'=>SORT_DESC]]
        ]);
        $commentProfile=new \app\models\CommentProfile();
        if($commentProfile->load(Yii::$app->request->post()) && $commentProfile->validate()){
            $commentProfile->profile_id=$profile_id;
            $commentProfile->save(false);
            return $this->redirect(Yii::$app->request->referrer);
        }
        return $this->render('comment_profile', ['comments'=>$comments, 'commentProfile'=>$commentProfile, 'model'=>$model]);
    }




    //comentni tahrirlash

    public function actionEditComment($comment_id, $user_id){
        $commentProfile=CommentProfile::findOne($comment_id);
        if($commentProfile->load(Yii::$app->request->post()) && $commentProfile->save(false)){
            Yii::$app->session->setFlash('success', 'Комментарии успешно редактирован');
            return $this->redirect(\yii\helpers\Url::toRoute(['/administration/client/comment-profile', 'profile_id'=>$user_id]));
        }
        return $this->render('comment_profile_edit', [ 'commentProfile'=>$commentProfile]);
    }







    //comentni uchirish
    public function actionDeleteComment($id, $user_id)
    {
        \app\models\CommentProfile::findOne($id)->delete();

        return $this->redirect(['comment-profile', 'profile_id'=>$user_id]);
    }
    //oblast
    public function actionOblastlar($strana_id)
    {
        $query=new Query();

        $query->select(['id', 'name_obl'])->from('regions')->where(['strana_id'=>$strana_id])->all();

        $command=$query->createCommand();
        $soni=$command->queryScalar();


        if($soni!=0)
        {
            $q=$command->queryAll();
            $str = '<option value="">--Выберите--</option>';
            foreach ($q as $item) {

                $str .='<option value="'.$item['id'].'">'.$item['name_obl'].'</option>';
            }
            return $str;
        }else
        {
            return 1;
        }
    }//oblast
    public function actionShaharlar($region_id)
    {
        $query=new Query();

        $query->select(['id', 'city_name'])->from('cities')->where(['region_id'=>$region_id])->all();

        $command=$query->createCommand();
        $soni=$command->queryScalar();


        if($soni!=0)
        {
            $q=$command->queryAll();
            $str = '<option value="">--Выберите--</option>';
            foreach ($q as $item) {

                $str .='<option value="'.$item['id'].'">'.$item['city_name'].'</option>';
            }
            return $str;
        }else
        {
            return 1;
        }
    }

    //klentga agaent biriktirish

    public function actionSetagent($id){
        $model=Profile::findOne($id);
        if(!Yii::$app->user->can('super_admin')){
            if(!( Yii::$app->user->can('IsRegion', ['profile'=>$model]) )){
                Yii::$app->session->setFlash('error', "Этом клент не ваш регион");

                return $this->redirect(['/administration/client']);
            }
        }
        if(Yii::$app->user->can('super_admin'))
            $AgentIds=\app\models\Profile::getIds("agent",null);
        else
            $AgentIds=\app\models\Profile::getIds("agent",  Yii::$app->user->identity->getRegionId());

        $modelAgent=\app\models\WeeksClientList::find()->where(['client_id'=>$id, 'user_id'=>$AgentIds, 'role_type'=>\app\models\WeeksClientList::ROLE_AGENT])->one();


        if(empty($modelAgent)){
            $modelAgent=new \app\models\WeeksClientList();
        }


        if($modelAgent->load(Yii::$app->request->post()) && $modelAgent->validate())
        {
            $modelAgent->role_type=\app\models\WeeksClientList::ROLE_AGENT;
            if($modelAgent->save()){
                Yii::$app->session->setFlash('success', 'Успешно');
                return $this->redirect(['/administration/client/client-info', 'id'=>$id]);
            }else{
                Yii::$app->session->setFlash('error', 'Ошибка');
                return $this->redirect(['/administration/client/client-info', 'id'=>$id]);
            }

        }
        return $this->render('setagaent', compact( 'modelAgent', 'id'));
    }

    public function actionSetcourier($id){
        $model=Profile::findOne($id);
        if(!Yii::$app->user->can('super_admin')){
            if(!( Yii::$app->user->can('IsRegion', ['profile'=>$model]))){
                Yii::$app->session->setFlash('error', "Этом клент не ваш регион");

                return $this->redirect(['/administration/client']);
            }
        }


        if(Yii::$app->user->can('super_admin'))
            $сouriersIds=\app\models\Profile::getIds("сouriers", null);
        else
            $сouriersIds=\app\models\Profile::getIds("сouriers", Yii::$app->user->identity->getRegionId());
        $modelCourier=\app\models\WeeksClientList::find()->where(['client_id'=>$id, 'user_id'=>$сouriersIds, 'role_type'=>\app\models\WeeksClientList::ROLE_COURER])->one();
        if(empty($modelCourier)){
            $modelCourier=new \app\models\WeeksClientList();
        }
        if($modelCourier->load(Yii::$app->request->post()) && $modelCourier->validate())
        {
            $modelCourier->role_type=\app\models\WeeksClientList::ROLE_COURER;
            if($modelCourier->save()){
                Yii::$app->session->setFlash('success', 'Успешно');
                return $this->redirect(['/administration/client/client-info', 'id'=>$id]);
            }else{
                Yii::$app->session->setFlash('error', 'Ошибка');
                return $this->redirect(['/administration/client/client-info', 'id'=>$id]);
            }

        }
        return $this->render('setcourier', compact('id', 'modelCourier'));
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    protected function findModel($id)
    {
        if (($model = Profile::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    /**
     * Creates a new Profile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Profile();
        //$model->scenario = Profile::SCENARIO_CREATE;
        $connection= \Yii::$app->db;
        $user_model=new \app\models\User();
        $registration=new \app\modules\administration\models\Regfiz();
//        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
//            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
//            return \yii\widgets\ActiveForm::validate($model);
//        }

        if ($registration->load(Yii::$app->request->post()) && $registration->validate()) {

            $transaction=$connection->beginTransaction();
            try{
//
//                $user_model->username=$model->username;
//                $user_model->password_hash=Yii::$app->getSecurity()->generatePasswordHash($model->password);
                //user formasiga
                $user_model->email=$registration->email;
                $user_model->telefon=$registration->telefon;
                $user_model->status=0;
                $user_model->save(false);

                $model->created_by=Yii::$app->user->getId();
                $user_model->username="UZB".$user_model->id;
                $user_model->auth_key = \Yii::$app->security->generateRandomString();
                $user_model->save(false);


                $model->user_id=$user_model->id;
                $model->firstname=$registration->ism;
                $model->lastname=$registration->familiya;
                $model->fathername=$registration->otasiningismi;
                $model->tell=$registration->telefon;
                $model->role="client";
                $model->is_juridical=10;
                $model->status=10;
                $model->region_id=$registration->oblast;
                $model->email=$registration->email;
                $model->save(false);



                $adresses=new \app\models\Adresses();

                $adresses->strana_id=$registration->strana;
                $adresses->profile_id=$model->user_id;
                $adresses->oblast_id=$registration->oblast;
                $adresses->city_id=$registration->gorod;
                $adresses->pochta_index=$registration->index;
                $adresses->street=$registration->ulitsa;
                $adresses->house=$registration->dom;
                $adresses->room=$registration->kvartera;
                $adresses->orientir=$registration->orenter;
                $adresses->save(false);

                if(!empty($registration->desc_comment)){
                    $CommentProfile=new \app\models\CommentProfile();
                    $CommentProfile->com_text =$registration->desc_comment;
                    $CommentProfile->sts=10;
                    $CommentProfile->profile_id=$model->user_id;
                    $CommentProfile->save(false);
                }


                $auth=Yii::$app->authManager;
                $rol=$auth->getRole("client");
                $auth->assign($rol, $user_model->id);

                Yii::$app->mailer->compose('auth_user', [
                    'user_name'=>$user_model->username,
                    'auth_key'=>$user_model->auth_key,
                    'familiya'=>$model->lastname,
                    'ism'=>$model->firstname,
                ])
                    ->setFrom("registration@creators.uz")
                    ->setTo($registration->email)
                    ->setSubject("Активация аккоунт")
                    ->send();
                Yii::$app->session->setFlash('success', 'Регистрация прошла успешно. Ваш номер ID: '.$user_model->username);
                $transaction->commit();
                return $this->redirect(['index']);
            }catch(Exceptin $e){
                $transaction->rollback();
            }
            return $this->redirect(['success', 'id' => $model->user_id]);
        }

        return $this->render('create', [
            'model' => $model,
            'registration' => $registration,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Пользователь успешно обновлено");
            return $this->redirect(['view', 'id' => $model->user_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

}
