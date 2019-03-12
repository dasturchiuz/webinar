<?php

namespace app\modules\administration\controllers;

use Yii;
use app\models\Profile;
use app\models\ProfileSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EmployeesController implements the CRUD actions for Profile model.
 */
class EmployeesController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access'=>[
                'class'=>\yii\filters\AccessControl::className(),
                'rules'=>[
                    [
                        'allow'=>true,
                        'roles'=>['super_admin',],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Profile models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProfileSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Profile model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Profile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Profile();

        $connection= \Yii::$app->db;
        $user_model=new \app\models\User();
        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return \yii\widgets\ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {
            $transaction=$connection->beginTransaction();
            try{
                $user_model->username=$model->username;
                $user_model->password_hash=Yii::$app->getSecurity()->generatePasswordHash($model->password);
                $user_model->email=$model->email;
                $user_model->created_at=time();
                $user_model->updated_at=time();
                $user_model->save(false);

                $model->created_at=time();
                $model->updated_at=time();
                $model->user_id=$user_model->getId();
                $model->save(false);
                $auth=Yii::$app->authManager;
                $rol=$auth->getRole($model->role);
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

    /**
     * Updates an existing Profile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->user_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Profile model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $connection = Yii::$app->db;
        $Employee= $this->findModel($id);
        $user=new \app\models\User();
        $transaction = $connection->beginTransaction();
        try {
            $us=$user->findOne($Employee->user_id);
            $manager = Yii::$app->authManager;
            $item = $manager->getRole($Employee->role);
            $manager->revoke( $item, $Employee->user_id );
            $us->delete();
            //$Employee->delete();
            $transaction->commit();
        }catch(Exception $e)
        {
            $transaction->rollBack();
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Profile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Profile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Profile::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
