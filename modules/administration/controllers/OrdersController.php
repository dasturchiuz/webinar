<?php

namespace app\modules\administration\controllers;

use app\models\Notfications;
use app\models\OrderStatusHistory;
use app\models\Profile;
use Yii;
use app\models\Orders;
use app\modules\administration\models\OrdersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class OrdersController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access'=>[
                'class'=>AccessControl::className(),
                'rules'=>[
                    [
                        'allow'=>true,
                        'roles'=>['admin', 'super_admin'],
                    ],
                    [
                        'actions' => ['index', 'view', 'create', 'courier'],
                        'allow'=>true,
                        'roles'=>['regional_managers', 'manager'],
                    ],
                    [
                        'actions' => ['index'],
                        'allow'=>true,
                        'roles'=>[ 'agent', 'сouriers'], //agent va kureyer faqat ko'ra oladi
                    ],
                ],
            ],
        ];
    }

    public function actionCheckout($order_id=null){

        return $this->render('checkout');
    }

    /**
     * Lists all Orders models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrdersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Orders model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

        $model=$this->findModel($id);
        $order_status=new OrderStatusHistory();
        if($order_status->load(Yii::$app->request->post()) && $order_status->validate())
        {
            $connection= \Yii::$app->db;
            $transaction=$connection->beginTransaction();
            try{
                $order_status->order_id=$id;
                $order_status->created_at = time();
                $order_status->updated_at = time();
                $model->status=$order_status->status;
                if($order_status->save(false) && $model->save(false)){

                    Yii::$app->session->setFlash('success', "Статус успешно обновлено");
                }else{
                    Yii::$app->session->setFlash('success', "Статус необновлено");
                }
                $transaction->commit();
            }catch(Exceptin $e){
                $transaction->rollback();
            }

            return $this->redirect(['view', 'id' => $id]);
        }
        return $this->render('view', [
            'model' => $model,
            'order_status'=>$order_status,
        ]);
    }

    /**
     * Creates a new Orders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Orders();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Orders model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        if (((Yii::$app->user->can('regional_managers') || Yii::$app->user->can('manager')) && Yii::$app->user->can('isRulePradaja', ['order' => $model])) && (Yii::$app->user->can('super_admin') || Yii::$app->user->can('admin')) )
        {
            return $this->render('update', [
                'model' => $model,
            ]);
        }else{
            Yii::$app->session->setFlash('error', 'Предупреждение: у вас нет разрешения!');
            return $this->redirect(['index']);
        }

    }
    //Курьер
    public function actionCourier($id){

        $model=$this->findModel($id);
        $order_status=new OrderStatusHistory();
        if($order_status->load(Yii::$app->request->post()) && $order_status->validate())
        {
            $connection= \Yii::$app->db;
            $transaction=$connection->beginTransaction();
            try{
                $order_status->order_id=$id;
                $order_status->created_at = time();
                $order_status->updated_at = time();
                $model->status=$order_status->status;

                if($order_status->save(false)){

                    Yii::$app->session->setFlash('success', "Статус успешно обновлено");
                }else{
                    Yii::$app->session->setFlash('success', "Статус необновлено");
                }
                $transaction->commit();
            }catch(Exceptin $e){
                $transaction->rollback();
            }

            return $this->redirect(['courier', 'id' => $id]);
        }
        //kurier uchun
        if($model->load(Yii::$app->request->post()))
        {
            $connection= \Yii::$app->db;
            $transaction=$connection->beginTransaction();
            try{
                $order_status->order_id=$id;
                $order_status->created_at = time();
                $order_status->updated_at = time();
                $curer= Profile::findOne($model->courier_id);
                $order_status->comment_status=$curer->lastname.' '.$curer->firstname.' '.$curer->fathername.' Логин: '.$curer->user->username.' Регион: '.$curer->oblast->name_obl;
                $model->status=Orders::STATUS_COURER;
                $order_status->status=Orders::STATUS_COURER;

                // notification for courer
                $notify=new Notfications();
                $notify->is_read=0;
                $notify->notfy_type_id=5;//new order priklipniy user
                $notify->profile_id=$model->courier_id;
                $notify->notfy_text="Sizda yangi zakaz mavjud";
                if($order_status->save(false) &&  $notify->save() && $model->save(false) ){

                    Yii::$app->session->setFlash('success', "Курьер успешно обновлено");
                }else{
                    Yii::$app->session->setFlash('success', "Курьер необновлено");
                }
                $transaction->commit();
            }catch(Exceptin $e){
                $transaction->rollback();
            }

            return $this->redirect(['courier', 'id' => $id]);
        }
        return $this->render('courer', [
            'model' => $model,
            'order_status'=>$order_status,
        ]);
    }

    /**
     * Deletes an existing Orders model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Orders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Orders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Orders::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
