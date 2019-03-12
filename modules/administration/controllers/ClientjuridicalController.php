<?php

namespace app\modules\administration\controllers;
use app\models\User;
use Yii;
use app\models\Profile;
use app\models\Adresses;
use app\models\Juridical;
use app\models\ProfileSearch;
use yii\filters\AccessControl;
use yii\db\Query;
use yii\data\ActiveDataProvider;
use app\models\CommentProfile;
class ClientjuridicalController extends \yii\web\Controller
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
                        'roles'=>['super_admin', 'admin',  'manager', ],
                    ],
                    [
                        'allow'=>true,
                        'actions'=>['index', 'client-info', 'edit'],
                        'roles'=>['buxgalter'],
                    ],
                    [
                        'allow'=>true,
                        'actions'=>[
                            'index',
                            'client-info',
                            'comment-profile',
                            'edit-comment',
                            'history-order',
                            'order-view',
                            'delete-comment',
                            'success',
                            'create'
                        ],
                        'roles'=>['agent', 'regional_managers', 'сouriers'],
                    ]

                ],
            ],
        ];
    }
    public function actionIndex()
    {
        $searchModel = new ProfileSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, 'client_juridical', null, null);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    //foydalanuvchini yozishmalari
    public function actionMessages($user_id){
        return $this->render('messages', compact('user_id'));
    }

    //foydalanuvchini yozishmalarini o';qish
    public function actionReadmessages($chat_room, $id, $user_id){
        return $this->render('readmessages', compact('user_id', 'chat_room', 'id'));
    }
    //klentga agaent biriktirish


    public function actionSetagent($id){
        $model=Profile::findOne($id);
        if(!Yii::$app->user->can('super_admin')){
            if(!( Yii::$app->user->can('IsRegion', ['profile'=>$model]))){
                Yii::$app->session->setFlash('error', "Этом клент не ваш регион");

                return $this->redirect(['/administration/clientjuridical']);
            }
        }
        if(Yii::$app->user->can('super_admin'))
            $AgentIds=\app\models\Profile::getIds("agent", null);
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
                return $this->redirect(['/administration/clientjuridical/client-info', 'id'=>$id]);
            }else{
                Yii::$app->session->setFlash('error', 'Ошибка');
                return $this->redirect(['/administration/clientjuridical/client-info', 'id'=>$id]);
            }

        }
        return $this->render('setagaent', compact( 'modelAgent', 'id'));
    }

    public function actionSetcourier($id){
        $model=Profile::findOne($id);
        if(!Yii::$app->user->can('super_admin')){
            if(!( Yii::$app->user->can('IsRegion', ['profile'=>$model]))){
                Yii::$app->session->setFlash('error', "Этом клент не ваш регион");

                return $this->redirect(['/administration/clientjuridical', 'id'=>$model->user_id]);
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
                return $this->redirect(['/administration/clientjuridical/client-info', 'id'=>$id]);
            }else{
                Yii::$app->session->setFlash('error', 'Ошибка');
                return $this->redirect(['/administration/clientjuridical/client-info', 'id'=>$id]);
            }

        }
        return $this->render('setcourier', compact('id', 'modelCourier'));
    }




    //klent ma'lumotlarini ko'rish
    public function actionClientInfo($id){

        $model=Profile::findOne($id);
        if(!( Yii::$app->user->can('IsRegion', ['profile'=>$model]) ) &&  Yii::$app->user->can('super_admin')==false){
            Yii::$app->session->setFlash('error', "Этом клент не ваш регион");

            return $this->redirect(['/administration/clientjuridical']);
        }
        return $this->render('info', compact('model'));
    }
    //comentlarni ko'rish
    public function actionCommentProfile($profile_id){
        $model=Profile::findOne($profile_id);
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




    public function actionBlackList($profile_id){
        $model=Profile::findOne($profile_id);
        if(!Yii::$app->user->can('super_admin')){

            if(! Yii::$app->user->can('IsRegion', ['profile'=>$model])){
                Yii::$app->session->setFlash('error', "Этом клент не ваш регион");

                return $this->redirect(['/administration/clientjuridical']);
            }
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

    public function actionUnBlackList($profile_id){
        $model=Profile::findOne($profile_id);
        if(!Yii::$app->user->can('super_admin')){
            if(!( Yii::$app->user->can('IsRegion', ['profile'=>$model]))){
                Yii::$app->session->setFlash('error', "Этом клент не ваш регион");

                return $this->redirect(['/administration/clientjuridical']);
            }
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




    //comentni tahrirlash

    public function actionEditComment($comment_id, $user_id){
        $commentProfile=CommentProfile::findOne($comment_id);
        if($commentProfile->load(Yii::$app->request->post()) && $commentProfile->save(false)){
            Yii::$app->session->setFlash('success', 'Комментарии успешно редактирован');
            return $this->redirect(\yii\helpers\Url::toRoute(['/administration/clientjuridical/comment-profile', 'profile_id'=>$user_id]));
        }
        return $this->render('comment_profile_edit', [ 'commentProfile'=>$commentProfile]);
    }


    public function actionHistoryOrder($profile_id){
        $model=Profile::findOne($profile_id);
        if(!Yii::$app->user->can('super_admin')){

                if(!( Yii::$app->user->can('IsRegion', ['profile'=>$model]))){
                Yii::$app->session->setFlash('error', "Этом клент не ваш регион");

                return $this->redirect(['/administration/client', 'id'=>$model->user_id]);
            }
        }
        $model=Profile::findOne($profile_id);
        $dataProvider=new ActiveDataProvider([
            'query'=>\app\models\Orders::find()->where(['user_id'=>$profile_id]),
            'sort'=> ['defaultOrder' => ['created_at'=>SORT_DESC]]
        ]);


        return $this->render('historyorder', compact('dataProvider', 'model'));
    }

     public function actionOrderView($profile_id, $order_id){
         $model=Profile::findOne($profile_id);
         if(!Yii::$app->user->can('super_admin')){

             if(!( Yii::$app->user->can('IsRegion', ['profile'=>$model]))){
                 Yii::$app->session->setFlash('error', "Этом клент не ваш регион");

                 return $this->redirect(['/administration/clientjuridical', 'id'=>$model->user_id]);
             }
         }
         $modelmagazin=Profile::findOne($profile_id);
         $model=\app\models\Orders::find()->where(['user_id'=>$profile_id, 'id'=>$order_id])->one();
        if($model==null)
        {
            Yii::$app->session->setFlash('error', 'Заказ не найдено');
            return $this->redirect(['history-order', 'profile_id'=>$profile_id]);
        }

        return $this->render('orderview', compact( 'model', 'modelmagazin'));
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

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    public function actionSuccess($id)
    {
        return $this->render('success_auth', [
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
        $registration=new \app\modules\administration\models\RegistrationForm();

        if ($registration->load(Yii::$app->request->post()) && $registration->validate()) {
            $userAction=new \app\models\config\UserActions($registration);
            if(($usernam=$userAction->RegistrationCompony()))
            {
                Yii::$app->session->setFlash('success', 'Регистрация прошла успешно. Ваш номер ID: '.$usernam."<br> Пожалуйста, проверьте ваш почтовый ящик ");
                return $this->redirect(['index']);
            }else{
                Yii::$app->session->setFlash('error', 'Не прошла успешно. Ваш номер ID: '.$usernam);
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'registration' => $registration,
        ]);
    }
    //yur litsoni tahrirlash
    public function actionEdit($profile_id){

        $model =Profile::findOne($profile_id);
        $user =\app\models\User::findOne($profile_id);
        $modelAdress=Adresses::find()->where(['profile_id'=>$model->user_id])->one();
        $modelJuridical=Juridical::find()->where(['profile_id'=>$model->user_id])->one();
        if(empty($model)){
            Yii::$app->session->setFlash('error', 'ID не существует: ');
            return $this->redirect(['index']);
        }
        if ($user->load(Yii::$app->request->post()) && $model->load(Yii::$app->request->post()) && $modelAdress->load(Yii::$app->request->post()) && $modelJuridical->load(Yii::$app->request->post())) {
//            echo "<pre>";
//            var_dump($modelJuridical);
//            die();
//
            $userAction=\app\models\config\UserActions::editCompony($model,$modelAdress ,$modelJuridical, $user);
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
            'modelJuridical' => $modelJuridical,
            'user' => $user,
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
