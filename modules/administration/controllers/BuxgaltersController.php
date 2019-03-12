<?php

namespace app\modules\administration\controllers;
use Yii;
use app\models\Profile;
use app\models\ProfileSearch;
use yii\filters\AccessControl;
class BuxgaltersController extends \yii\web\Controller{

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
    public function actionIndex(){

        $searchModel = new ProfileSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, 'buxgalter');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate(){
        $model = new Profile();
        $model->scenario = Profile::SCENARIO_REGIONAL_MANAGER;

        $connection= \Yii::$app->db;
        $user_model=new \app\models\User();
//        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
//            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
//            return \yii\widgets\ActiveForm::validate($model);
//        }
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $transaction=$connection->beginTransaction();
            try{
                $model->role="buxgalter";
                if(Yii::$app->user->can('admin') ||Yii::$app->user->can('regional_managers') || Yii::$app->user->can('manager')){
                    $model->region_id=Yii::$app->user->identity->getRegionId();
                }
                $user_model->username=$model->username;
                $user_model->password_hash=Yii::$app->getSecurity()->generatePasswordHash($model->password);
                $user_model->email=$model->email;
                $user_model->save(false);
                $model->user_id=$user_model->getId();
                $model->created_by=Yii::$app->user->getId();
                $model->save(false);
                $auth=Yii::$app->authManager;
                $rol=$auth->getRole("buxgalter");
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

    public function actionView($id)
    {
        $model=$this->findModel($id);
        if(!Yii::$app->user->can('super_admin')){
            if(!\app\models\config\Ruxsatnoma::isHuquqRahbariyat())
            {
                Yii::$app->session->setFlash('error', 'Предупреждение: у вас нет разрешения!');
                return $this->redirect(['index']);
            }
        }
        return $this->render('view', [
            'model' => $model,

        ]);
    }
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if(!Yii::$app->user->can('super_admin')){
            if(!Yii::$app->user->can('IsRegion', ['profile'=>$model])){
                Yii::$app->session->setFlash('error', 'Предупреждение: у вас нет разрешения!');
                return $this->redirect(['index']);
            }
        }


        if ($model->load(Yii::$app->request->post())) {
            if(!Yii::$app->user->can('super_admin')){
                $model->region_id=Yii::$app->user->identity->getRegionId();
            }
            $model->save(false);
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
            Yii::$app->session->setFlash('success', "Бухгалтер успешно удалён");
            return $this->redirect(['index']);
        }else{
            Yii::$app->session->setFlash('error', "Ошибка удалена");
            return $this->redirect(['index']);
        }
    }

    protected function findModel($id)
    {
        if (($model = Profile::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }


}