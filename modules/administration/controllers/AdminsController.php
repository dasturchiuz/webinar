<?php

namespace app\modules\administration\controllers;
use Yii;
use app\models\Profile;
use app\models\ProfileSearch;
use yii\filters\AccessControl;

class AdminsController extends \yii\web\Controller
{

    public function behaviors(){
        return [
            'access'=>[
                'class'=>AccessControl::className(),
                'rules'=>[
                    [
                        'allow'=>true,
                        'roles'=>['super_admin', ],
                    ],
                ],
            ],
        ];
    }
    public function actionIndex()
    {
        $searchModel = new ProfileSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, 'admin');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionBlackList($profile_id){

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

        if(\app\models\config\UserActions::unBlock($profile_id))
        {
            Yii::$app->session->setFlash('success', 'Клиент разблокирован в чёрный список');
            return $this->redirect(Yii::$app->request->referrer);
        }else{
            Yii::$app->session->setFlash('error', 'Ошибка! Причина уже в список или не сущ');
            return $this->redirect(Yii::$app->request->referrer);
        }
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
        $model->scenario = Profile::SCENARIO_CREATE;
        $connection= \Yii::$app->db;
        $user_model=new \app\models\User();
//        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
//            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
//            return \yii\widgets\ActiveForm::validate($model);
//        }
        $model->role="admin";
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $transaction=$connection->beginTransaction();
            try{
                $user_model->username=$model->username;
                $user_model->password_hash=Yii::$app->getSecurity()->generatePasswordHash($model->password);
                $user_model->email=$model->email;
                $user_model->save(false);

                $model->created_by=Yii::$app->user->getId();
                $model->user_id=$user_model->getId();
                $model->save(false);
                $auth=Yii::$app->authManager;
                $rol=$auth->getRole("admin");
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
    public function actionLevelcontrol($id){
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->session->setFlash('success', "Пользователь успешно обновлено");
            return $this->redirect(['view', 'id' => $model->user_id]);
        }

        return $this->render('setlevel', [
            'model' => $model,
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

    public function actionDelete($id)
    {
        $model= $this->findModel($id);
        if(\app\models\config\UserActions::userDelete($model)){
            Yii::$app->session->setFlash('success', "Администратор успешно удалён");
            return $this->redirect(['index']);
        }else{
            Yii::$app->session->setFlash('error', "Ошибка удалена");
            return $this->redirect(['index']);
        }
    }

}
