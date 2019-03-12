<?php

namespace app\modules\administration\controllers;
use Yii;
use app\models\Profile;
use app\models\ProfileSearch;
use yii\filters\AccessControl;
class ManagerController extends \yii\web\Controller
{
    public function behaviors(){
        return [
            'access'=>[
                'class'=>AccessControl::className(),
                'rules'=>[
                    [
                        'allow'=>true,
                        'roles'=>['super_admin', 'admin',],
                    ],
                ],
            ],
        ];
    }
    public function actionIndex()
    {
        $searchModel = new ProfileSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, 'manager');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionBlackList($profile_id){

        if(\app\models\config\UserActions::setBlock($profile_id))
        {
            Yii::$app->session->setFlash('success', 'Менеджер поставлен в чёрный список');
            return $this->redirect(Yii::$app->request->referrer);
        }else{
            Yii::$app->session->setFlash('error', 'Ошибка! Причина уже в список или не сущ');
            return $this->redirect(Yii::$app->request->referrer);
        }
    }

    public function actionUnBlackList($profile_id){

        if(\app\models\config\UserActions::unBlock($profile_id))
        {
            Yii::$app->session->setFlash('success', 'Менеджер разблокирован в чёрный список');
            return $this->redirect(Yii::$app->request->referrer);
        }else{
            Yii::$app->session->setFlash('error', 'Ошибка! Причина уже в список или не сущ');
            return $this->redirect(Yii::$app->request->referrer);
        }
    }
    public function actionView($id)
    {
        $model=$this->findModel($id);
        if(!Yii::$app->user->can('super_admin')){
            if(!Yii::$app->user->can('IsRegion', ['profile'=>$model]) &&  Yii::$app->user->can('admin') ){
                Yii::$app->session->setFlash('error', 'Предупреждение: у вас нет разрешения!');
                return $this->redirect(['index']);
            }
        }

        return $this->render('view', [
                'model' => $model,
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
        $model->scenario = Profile::SCENARIO_REGIONAL_MANAGER;

        $connection= \Yii::$app->db;
        $user_model=new \app\models\User();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $transaction=$connection->beginTransaction();
            try{
                $model->role="manager";
                if(!Yii::$app->user->can('super_admin')){
                    $model->region_id=Yii::$app->user->identity->getRegionId();
                }
                if(Yii::$app->user->can('admin')){
                    $model->region_id=Yii::$app->user->identity->getRegionId();
                }
                $user_model->username=$model->username;
                $user_model->password_hash=Yii::$app->getSecurity()->generatePasswordHash($model->password);
                $user_model->email=$model->email;
                $user_model->save(false);
                $model->created_by=Yii::$app->user->getId();
                $model->user_id=$user_model->getId();
                $model->save(false);
                $auth=Yii::$app->authManager;
                $rol=$auth->getRole("manager");
                $auth->assign($rol, $user_model->id);
                $transaction->commit();

                return $this->redirect(['view', 'id' => $model->user_id]);
            }catch(Exceptin $e){
                $transaction->rollback();
            }
            return $this->redirect(['view', 'id' => $model->user_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    public function actionDelete($id)
    {
        $model= $this->findModel($id);
//        if(Yii::$app->user->can('super_admin')){
//            if(\app\models\config\UserActions::userDelete($model)){
//                Yii::$app->session->setFlash('success', "Администратор успешно удалён");
//                return $this->redirect(['index']);
//            }else{
//                Yii::$app->session->setFlash('error', "Ошибка удалена");
//                return $this->redirect(['index']);
//            }
//        }


        if(!( Yii::$app->user->can('IsRegion', ['profile'=>$model]) &&  Yii::$app->user->can('admin')) && !Yii::$app->user->can('super_admin')){
            Yii::$app->session->setFlash('error', 'Предупреждение: у вас нет разрешения!');
            return $this->redirect(['index']);
        }
            $model->delete();
            Yii::$app->session->setFlash('success', 'Менеджер успешно удален');
            return $this->redirect(['index']);

    }

//    public function actionDelete($id)
//    {
//        $model= $this->findModel($id);
//        if(\app\models\config\UserActions::userDelete($model)){
//            Yii::$app->session->setFlash('success', "Администратор успешно удалён");
//            return $this->redirect(['index']);
//        }else{
//            Yii::$app->session->setFlash('error', "Ошибка удалена");
//            return $this->redirect(['index']);
//        }
//    }


    public function actionUpdate($id)
    {

       // $UpdateProfile=new \app\models\UpdateProfile();
//        if ($UpdateProfile->load(Yii::$app->request->post())) {
//            $model->firstname=$UpdateProfile->firstname;
//            $model->lastname=$UpdateProfile->lastname;
//            $model->fathername=$UpdateProfile->fathername;
//            $model->tell=$UpdateProfile->tell;
//            $model->region_id=$UpdateProfile->region_id;
//            $model->adress=$UpdateProfile->adress;
//            $model->save(false);
//            Yii::$app->session->setFlash('success', "Товар успешно добавлен");
//            return $this->redirect(['view', 'id' => $model->user_id]);
//        }
//        $UpdateProfile->user_id=$model->user_id;
//        $UpdateProfile->firstname=$model->firstname;
//        $UpdateProfile->lastname=$model->lastname;
//        $UpdateProfile->fathername=$model->fathername;
//        $UpdateProfile->tell=$model->tell;
//        $UpdateProfile->region_id=$model->region_id;
//        $UpdateProfile->fullnameemp=$model->fullnameemp;
//        $UpdateProfile->adress=$model->adress;


//        return $this->render('update', [
//            'model' => $UpdateProfile,
//        ]);

        $model = $this->findModel($id);
        if(!Yii::$app->user->can('super_admin')){
            if(!( Yii::$app->user->can('IsRegion', ['profile'=>$model]) &&  Yii::$app->user->can('admin')) ){
                Yii::$app->session->setFlash('error', 'Предупреждение: у вас нет разрешения!');
                return $this->redirect(['index']);
            }
        }

        if ($model->load(Yii::$app->request->post()) ) {
            if(!Yii::$app->user->can('super_admin')){
                $model->region_id=Yii::$app->user->identity->getRegionId();
            }
            $model->save();
            Yii::$app->session->setFlash('success', "Пользователь успешно обновлено");
            return $this->redirect(['view', 'id' => $model->user_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

}
