<?php

namespace app\modules\administration\controllers;
use Yii;
use app\models\Profile;
use app\models\ProfileSearch;
use yii\filters\AccessControl;
use app\models\ProfileWeekSearch;
class AgentController extends \yii\web\Controller
{
    public function behaviors(){
        return [
            'access'=>[
                'class'=>AccessControl::className(),
                'rules'=>[
                    [
                        'allow'=>true,
                        'roles'=>['super_admin', 'admin', 'regional_managers', 'manager'],
                    ]
                    ,
                    [
                        'allow'=>true,
                        'actions'=>['index', 'view', 'edit'],
                        'roles'=>['buxgalter'],
                    ]
                ],
            ],
        ];
    }
    public function actionIndex()
    {
        $searchModel = new ProfileSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, 'agent');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionBlackList($profile_id){

        if(\app\models\config\UserActions::setBlock($profile_id))
        {
            Yii::$app->session->setFlash('success', 'Агент  поставлен в чёрный список');
            return $this->redirect(Yii::$app->request->referrer);
        }else{
            Yii::$app->session->setFlash('error', 'Ошибка! Причина уже в список или не сущ');
            return $this->redirect(Yii::$app->request->referrer);
        }
    }

    public function actionUnBlackList($profile_id){

        if(\app\models\config\UserActions::unBlock($profile_id))
        {
            Yii::$app->session->setFlash('success', 'Агент разблокирован в чёрный список');
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
            if(!\app\models\config\Ruxsatnoma::isHuquqRahbariyat())
            {
                Yii::$app->session->setFlash('error', 'Предупреждение: у вас нет разрешения!');
                return $this->redirect(['index']);
            }
        }

        //agentni clientlarini olish
        $searchModel = new ProfileWeekSearch();
        $dataAgentClients = $searchModel->search_agent_clients($model->user_id);


        return $this->render('view', [
            'model' => $model,
            'dataAgentClients' => $dataAgentClients,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Profile::findOne($id)) !== null) {
            return $model;
        }

        Yii::$app->session->setFlash('error', 'При вводе произошла ошибка!');
        return $this->redirect(['index']);
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
//        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
//            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
//            return \yii\widgets\ActiveForm::validate($model);
//        }
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $transaction=$connection->beginTransaction();
            try{
                $model->role="agent";
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
                $rol=$auth->getRole("agent");
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

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if(!Yii::$app->user->can('super_admin')){
            if(!Yii::$app->user->can('IsRegion', ['profile'=>$model])){
                Yii::$app->session->setFlash('error', 'Предупреждение: у вас нет разрешения!');
                return $this->redirect(['index']);
            }
        }


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(!Yii::$app->user->can('super_admin')){
                $model->region_id=Yii::$app->user->identity->getRegionId();
            }
            $model->save();
            Yii::$app->session->setFlash('success', "Агент успешно обновлено");
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
            Yii::$app->session->setFlash('success', "Агент успешно удалён");
            return $this->redirect(['index']);
        }else{
            Yii::$app->session->setFlash('error', "Ошибка удалена");
            return $this->redirect(['index']);
        }
    }
}
