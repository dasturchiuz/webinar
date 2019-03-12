<?php

namespace app\controllers;
use app\models\Orders;
use app\models\Profile;
use app\models\Productreviews;
use app\models\UserImages;
use Yii;
use app\models\Passwordchange;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use app\models\LoginForm;
use yii\db\Query;use app\models\ProductSearch;

class AccountController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],[
                        'allow'=>true,
                        'roles'=>['?']
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['get'],
                    'status-order' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('error', 'Предупреждение: у вас нет разрешения!');
            return $this->goHome();
        }
        $model=Profile::findOne(Yii::$app->user->identity->id);
        return $this->render('index', compact('model'));

    }

    public function actionProfile(){
        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('error', 'Предупреждение: у вас нет разрешения!');
            return $this->goHome();
        }
        $model=Profile::findOne(Yii::$app->user->identity->id);
        $modelProfile=new Profile();
        $modelProfile->scenario=Profile::SCENARIO_IMAGE;
        if($modelProfile->load(Yii::$app->request->post())){
            //tekshirish
            if(UserImages::find()->where(['user_id'=>$model->user_id])->exists()){
                $userimage=UserImages::find()->where(['user_id'=>$model->user_id])->one();
                unlink($userimage->path_to_file);
                $userimage->delete();
            }
            //yuklash
            $modelProfile->user_image = \yii\web\UploadedFile::getInstance($modelProfile, 'user_image');
            $path=Yii::getAlias('@app')."/userimages/".$model->usernameid.".".$modelProfile->user_image->extension;
            $modelProfile->user_image->saveAs($path);
            $userimage=new \app\models\UserImages();
            $userimage->path_to_file=$path;
            $userimage->mimeType=$modelProfile->user_image->type;
            $userimage->user_id=$model->user_id;
            if($userimage->save()){
               Yii::$app->session->setFlash('success', 'Uspeshno');
               return $this->redirect(['/account/profile']);
            }
        }


        return $this->render('profile', compact('model', 'modelProfile'));
    }

    public function actionLogo(){
        $model=Profile::findOne(Yii::$app->user->identity->id);
        if(!empty($model->logo))
            return $model->logo->logo;
        else
           return Yii::$app->response->sendFile(Yii::getAlias("@app")."/web/images/default-avatar.png")->send();
    }

//    public function actionProducts(){
//        if (Yii::$app->user->isGuest) {
//            Yii::$app->session->setFlash('error', 'Предупреждение: у вас нет разрешения!');
//            return $this->goHome();
//        }
//        $searchModel = new ProductSearch();
//        $dataProvider = $searchModel->searchByUserId(Yii::$app->user->identity->id);
//        $model=Profile::findOne(Yii::$app->user->identity->id);
//
//        return $this->render('products', compact('model', 'dataProvider', 'searchModel'));
//    }


    public function actionAddress(){
        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('error', 'Предупреждение: у вас нет разрешения!');
            return $this->goHome();
        }
        $model=Profile::findOne(Yii::$app->user->identity->id);
        return $this->render('adress', compact('model'));
    }
    public function actionBankDetails(){
        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('error', 'Предупреждение: у вас нет разрешения!');
            return $this->goHome();
        }
        $model=Profile::findOne(Yii::$app->user->identity->id);
        return $this->render('bank', compact('model'));
    }
    public function actionWishlist(){
        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('error', 'Предупреждение: у вас нет разрешения!');
            return $this->goHome();
        }
        $model=Profile::findOne(Yii::$app->user->identity->id);
        return $this->render('wishlist', compact('model'));
    }

    public function actionChangePassword(){
        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('error', 'Предупреждение: у вас нет разрешения!');
            return $this->goHome();
        }
        $modelProfile=Profile::findOne(Yii::$app->user->identity->id);
        $model=new Passwordchange(['scenario'=>Passwordchange::SCENARIO_PSWD_USER]);
        if($model->load(Yii::$app->request->post()) && $model->validate())
        {
            $user=\app\models\User::findOne(Yii::$app->user->getId());
            $user->password_hash=Yii::$app->getSecurity()->generatePasswordHash($model->new_pswd);
            $user->save(false);
            Yii::$app->session->setFlash('success', 'Пароль успешно изменен');
            return $this->redirect(Yii::$app->request->referrer);
        }


        return $this->render('password', compact('model', 'modelProfile'));
    }


//    public function actionOrders()
//    {
//        if (Yii::$app->user->isGuest) {
//            Yii::$app->session->setFlash('error', 'Предупреждение: у вас нет разрешения!');
//            return $this->goHome();
//        }
//
//        $orders=new ActiveDataProvider([
//            'query'=>Orders::find()->where(['user_id'=>Yii::$app->user->identity->id]),
//            'sort'=>[
//                'defaultOrder'=>[
//                    'created_at'=>SORT_DESC,
//                ],
//            ],
//            'pagination'=>[
//                'pageSize'=>20,
//            ],
//        ]);
//        return $this->render('orders', compact('orders'));
//    }



    public function actionComment()
    {
        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('error', 'Предупреждение: у вас нет разрешения!');
            return $this->goHome();
        }

        $model=new ActiveDataProvider([
            'query'=>Productreviews::find()->where(['user_id'=>Yii::$app->user->identity->id]),
            'sort'=>[
                'defaultOrder'=>[
                    'created_at'=>SORT_ASC,
                ],
            ],
            'pagination'=>[
                'pageSize'=>20,
            ],
        ]);
        return $this->render('comments', compact('model'));

    }


    public function actionSignup()
    {
//        $modelProfile=new \app\models\Profile();
//        $modelUser=new \app\models\User();
//        $modelJuridical=new \app\models\Juridical();
//        $Registration=new \app\models\Registration();
////  && $modelJuridical->validate()
//        if(Yii::$app->request->isAjax && $Registration->load($_POST) )
//        {
//            Yii::$app->response->format='json';
//            return \yii\widgets\ActiveForm::validate($Registration);
//        }
//
//        if($Registration->load(Yii::$app->request->post())   )
//        {
//            $con=Yii::$app->db;
//            $role="client";
//            try{
//                $transaction=$con->beginTransaction();
//                    //user
//                    $modelUser->username= $Registration->email;
//                    $modelUser->setPassword($Registration->password);
//                    $modelUser->generateAuthKey();
//                    $modelUser->email= $Registration->email;
//                    $modelUser->status=0;
//                    $modelUser->created_at= time();
//                    $modelUser->updated_at= time();
//                    $modelUser->save(false);
//                    //profil
//                $modelProfile->user_id=$modelUser->id;
//                $modelProfile->firstname=$Registration->firstname;
//                $modelProfile->lastname=$Registration->lastname;
//                $modelProfile->fathername=$Registration->fathername;
//                $modelProfile->tell=$Registration->tell;
//                $modelProfile->region_id=$Registration->region_id;
//                $modelProfile->adress=$Registration->adress;
//                $modelProfile->updated_at= time();
//                $modelProfile->created_at= time();
//                $modelProfile->is_juridical=$Registration->is_juridical;
//                if($Registration->is_juridical==1)
//                {
//
//                    $modelJuridical->id=$modelUser->id;
//                    $modelJuridical->tashkilot=$Registration->tashkilot;
//                    $modelJuridical->bank=$Registration->bank;
//                    $modelJuridical->hisobraqam=$Registration->hisobraqam;
//                    $modelJuridical->oked=$Registration->oked;
//                    $modelJuridical->inn=$Registration->inn;
//                    $modelJuridical->mfo=$Registration->mfo;
//                    $modelJuridical->save();
//                    $role="client_juridical";
//                }
//                $modelProfile->role=$role;
//                $modelProfile->save(false);
//
//                $auth = Yii::$app->authManager;
//                $r=$auth->getRole($role);
//                $auth->assign($r, $modelUser->id);
//
//                $transaction->commit();
//                $confirmlink=\yii\helpers\Html::a('confirm', Yii::$app->urlManager->createAbsoluteUrl(['account/confirm', 'id'=>$modelUser->id, 'key'=>$modelUser->auth_key]));
//                $email=mail("joecool@example.com", "My Subject", "Line 1\nLine 2\nLine 3".$confirmlink);
////                $email=Yii::$app->mailer->compose()
////                    ->setFrom('dasturchiuz@gmail.com')
////                    ->setTo('dasturchiuz@gmail.com')
////                    ->setSubject('Signup confrimation')
////                    ->setHtmlBody("Click this link <a href='#'>CLICK THIS</a>")
////                    ->send();
//                if($email){
//                    Yii::$app->getSession()->setFlash('success', 'PLS check your email');
//
//                }else{
//                    Yii::$app->getSession()->setFlash('warning','Failed, contact Admin!');
//                }
//                return $this->goHome();
//            }catch(\Exception $e){
//                $transaction->rollback();
//            }
//
//        }

        return $this->render('first' );
    }




    public function actionSignupCompany(){
        $registration=new \app\modules\administration\models\RegistrationForm();
        if ($registration->load(Yii::$app->request->post()) && $registration->validate()) {
            $userAction=new \app\models\config\UserActions($registration);
            if(($usernam=$userAction->RegistrationCompony()))
            {
                Yii::$app->session->setFlash('success', 'Регистрация прошла успешно. <br> <strong>Ваш номер ID:</strong> '.$usernam."<br> Пожалуйста, проверьте ваш почтовый ящик ");
                return $this->redirect(['success']);
            }else{
                Yii::$app->session->setFlash('error', 'Не прошла успешно. Ваш номер ID: '.$usernam);
                return $this->redirect(['success']);
            }
        }
        return $this->render('signcompony', [
            'registration' => $registration,
        ]);
    }
    public function actionSignupUser(){

        $registration=new \app\modules\administration\models\Regfiz();
        if ($registration->load(Yii::$app->request->post()) && $registration->validate()) {
            $userAction=new \app\models\config\UserActions($registration);
            if(($usernam=$userAction->RegistrationUser()))
            {
                Yii::$app->session->setFlash('success', 'Регистрация прошла успешно. Ваш номер ID: '.$usernam."<br> Пожалуйста, проверьте ваш почтовый ящик ");
                return $this->redirect(['success']);
            }else{
                Yii::$app->session->setFlash('error', 'Не прошла успешно. Ваш номер ID: '.$usernam);
                return $this->redirect(['success']);
            }
        }
        return $this->render('signuser', [
            'registration' => $registration,
        ]);
    }

    public function actionResult(){
        return $this->render('result');
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
    public function actionConfirm($id, $key)
    {
        $user = \app\models\User::find()->where([
        'id'=>$id,
        'auth_key'=>$key,
        'status'=>0,
        ])->one();
        if(!empty($user)){
            $user->status=10;
            $user->save();
            Yii::$app->getSession()->setFlash('success','Success!');
        }
        else{
            Yii::$app->getSession()->setFlash('warning','Failed!');
        }
        return $this->goHome();
    }

    public function actionConfirmClient($login, $auth_key){
        $user = \app\models\User::find()->where([
            'username'=>$login,
            'auth_key'=>$auth_key,
            'status'=>0,
        ])->one();
        $Activation=new \app\models\Activation();
        $Activation->scenario = \app\models\Activation::ONE_STEP;
        if($Activation->load(Yii::$app->request->post()) && $Activation->validate())
        {

            $user_two = \app\models\User::find()->where([
                'username'=>$Activation->username,
                'auth_key'=>$Activation->auth_key,
                'telefon'=>$Activation->telefon,
                'status'=>0,
            ])->one();

            if(!empty($user_two)){
                return $this->redirect(
                    [
                        '/account/confirm-client-two',
                        'login'=>$user_two->username,
                        'auth_key'=>$user_two->auth_key,
                        'telefon'=>$user_two->telefon
                    ]
                );
            }
            else{

                return $this->render('activation', ['Activation'=>$Activation, 'user'=>$user]);
            }
        }
        return $this->render('activation', compact('Activation', 'user'));
    }

    public function actionConfirmClientTwo($login, $auth_key, $telefon){
        $user = \app\models\User::find()->where([
            'user_id'=>$login,
            'auth_key'=>$auth_key,
            'telefon'=>$telefon,
            'status'=>0,
        ])->one();
        $connection= \Yii::$app->db;
        $Activation=new \app\models\Activation();
        $Activation->scenario = \app\models\Activation::TWO_STEP;
        if($Activation->load(Yii::$app->request->post()) && $Activation->validate())
        {
            if(empty($user)){
                Yii::$app->session->setFlash('error', "Не существует");
                return $this->redirect(Yii::$app->request->referrer);
            }

            $profile=\app\models\Profile::find()->where(['user_id'=>$user->id])->one();
            if($profile->name_magazin==null){
                $transaction=$connection->beginTransaction();
                try{

                    $user->username=$Activation->login;
                    $user->password_hash=\Yii::$app->getSecurity()->generatePasswordHash($Activation->pswd);
                    $user->auth_key = \Yii::$app->security->generateRandomString();
                    $user->status = 10;
                    $user->save(false);

                    $profile->name_magazin=$Activation->main_name;
                    $profile->status=10;
                    $profile->save(false);
                    $transaction->commit();
                    Yii::$app->session->setFlash('success', "Активация прошла успешно!
Обратитесь к администратору сайта для полной активации.");
                    return $this->redirect(['/account/login']);
                }catch(Exceptin $e){
                    $transaction->rollback();
                }

            }else{
                Yii::$app->session->setFlash('error', "уже задано имя пользователя");
                return $this->redirect(Yii::$app->request->referrer);
            }
        }

        return $this->render('activation_two', compact('Activation', 'user'));

    }


    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionSuccess(){
        return $this->render('result');
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

}
