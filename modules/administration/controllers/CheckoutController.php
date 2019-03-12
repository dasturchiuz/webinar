<?php

namespace app\modules\administration\controllers;
use Yii;
use yii\widgets\ActiveForm;
use app\models\Profile;
use app\models\ProductSearch;
use app\models\Product;
use app\models\Cart;
use yii\data\ActiveDataProvider;
use app\models\CommentProfile;
use app\models\Invoice;
use app\models\Orders;
use app\models\Debitor;
use app\models\User;
use yii\helpers\Url;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Response;
class CheckoutController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'deleteitem' => ['POST'],
                    'add-to-order' => ['POST'],
                ],
            ],
            'access'=>[
                'class'=>AccessControl::className(),
                'rules'=>[
                    [
                        'allow'=>true,
                        'roles'=>['super_admin', 'admin', 'regional_managers', 'manager', 'buxgalter', 'agent', 'сouriers'],
                    ],

                ],
            ],
        ];
    }

    public function actionVdolg($profile_id, $order_id){
        $order=Orders::findOne($order_id);
        if($order->status!=Orders::STATUS_NEW)
        {
            Yii::$app->session->setFlash('success', 'Уже оформлено');
            return $this->redirect(['/administration/history-order/order-view', 'profile_id'=>$profile_id, 'order_id'=>$order_id]);
        }
        $modelForm=new \yii\base\DynamicModel([
            'order_id', 'comment_text', 'date'
        ]);
        $modelForm->addRule(['comment_text', 'date', ], 'required');
        $modelForm->addRule(['order_id'], 'required', ['message'=>'Вы не виберил заказ']);
        if($modelForm->load(Yii::$app->request->post()))
        {



            if(Yii::$app->user->can('IsCourierClient', ['order'=>$modelForm->order_id]) == false)
            {
                Yii::$app->session->setFlash('success', 'Это не ваш клиент');
                return $this->redirect(['/administration/history-order/order-view', 'profile_id'=>$profile_id, 'order_id'=>$order_id]);
            }
            if(count($order) != 0){
                $conn=Yii::$app->db;
                $transaction=$conn->beginTransaction();
                try{

                    $Debitor=new Debitor();
                    $Debitor->order_id=$order->id;
                    $Debitor->amount=$order->sum;
                    $Debitor->profile_id=$order->user_id;
                    $Debitor->repay_date=$modelForm->date;
                    $Debitor->save(false);

                    $comment=new CommentProfile();
                    $comment->profile_id=$order->user_id;
                    $comment->com_text='Офоримть доставка №'.$order->id." в долг Время дату: ".$modelForm->date." <br>".$modelForm->comment_text;
                    $comment->save(false);


                    $order->status=Orders::STATUS_ZAKUPKA_DOLG;
                    $order->delivery_status=Orders::STATUS_DELIVERID;
                    $order->delivered_date=date('Y-m-d H:i:s');
                    $order->save(false);
                    $transaction->commit();
                }catch(\Exception $e){
                    $transaction->rollback();
                }

                Yii::$app->session->setFlash('success', 'Успешно №'.$order->id." Время дату: ".$order->delivery_date);
                return $this->redirect(['/administration/history-order/order-view', 'profile_id'=>$profile_id, 'order_id'=>$order_id]);
            }else{
                Yii::$app->session->setFlash('error', 'Заказ не существует');
                return $this->redirect(['/administration/history-order/order-view', 'profile_id'=>$profile_id, 'order_id'=>$order_id]);
            }
        }

        $modelmagazin=Profile::findOne($profile_id);
        $model=\app\models\Orders::find()->where(['user_id'=>$profile_id, 'id'=>$order_id])->one();
        if($model==null)
        {
            Yii::$app->session->setFlash('error', 'Заказ не найдено');
            return $this->redirect(['history-order', 'profile_id'=>$profile_id]);
        }

        return $this->render('orderdolg', compact( 'model', 'modelmagazin', 'modelForm'));
    }



    public function actionRenouncement($profile_id, $order_id){
        $order=Orders::findOne($order_id);
        if($order->status!=Orders::STATUS_NEW)
        {
            Yii::$app->session->setFlash('error', 'Уже этом заказ оформлено');
            return $this->redirect(['/administration/history-order/order-view', 'profile_id'=>$profile_id, 'order_id'=>$order_id]);
        }
        $modelForm=new \yii\base\DynamicModel([
            'order_id', 'comment_text',
        ]);
        $modelForm->addRule(['comment_text',  ], 'required');
        $modelForm->addRule(['order_id'], 'required', ['message'=>'Вы не виберил заказ']);
        if($modelForm->load(Yii::$app->request->post()))
        {
                if(!Yii::$app->user->can('super_admin')){
                    if(Yii::$app->user->can('IsCourierClient', ['order'=>$modelForm->order_id]) == false)
                    {
                        Yii::$app->session->setFlash('error', 'Это не ваш клиент');
                        return $this->redirect(['/administration/history-order/order-view', 'profile_id'=>$profile_id, 'order_id'=>$order_id]);
                    }
                }

            if(count($order) != 0){
                $conn=Yii::$app->db;
                $transaction=$conn->beginTransaction();
                try{



                    $comment=new CommentProfile();
                    $comment->profile_id=$order->user_id;
                    $comment->com_text='Офоримть доставка №'.$order->id." отказано <br>".$modelForm->comment_text;
                    $comment->save(false);


                    $order->status=Orders::STATUS_ZAKUPKA_OTKAZ;
                    $order->delivery_status=Orders::STATUS_DELIVERID;
                    $order->delivered_date=date('Y-m-d H:i:s');
                    $order->save(false);
                    $transaction->commit();
                }catch(\Exception $e){
                    $transaction->rollback();
                }

                Yii::$app->session->setFlash('success', 'Успешно №'.$order->id." отказано");
                return $this->redirect(['/administration/history-order/order-view', 'profile_id'=>$profile_id, 'order_id'=>$order_id]);
            }else{
                Yii::$app->session->setFlash('error', 'Заказ не существует');
                return $this->redirect(['/administration/history-order/order-view', 'profile_id'=>$profile_id, 'order_id'=>$order_id]);
            }
        }

        $modelmagazin=Profile::findOne($profile_id);
        $model=\app\models\Orders::find()->where(['user_id'=>$profile_id, 'id'=>$order_id])->one();
        if($model==null)
        {
            Yii::$app->session->setFlash('error', 'Заказ не найдено');
            return $this->redirect(['history-order', 'profile_id'=>$profile_id]);
        }

        return $this->render('orderotkaz', compact( 'model', 'modelmagazin', 'modelForm'));
    }

    public function actionPayhere($profile_id, $order_id){
        $modelProfile=Profile::findOne($profile_id);
        if(!Yii::$app->user->can('super_admin')){
            if(!( Yii::$app->user->can('IsRegion', ['profile'=>$modelProfile]))){
                Yii::$app->session->setFlash('error', "Этом клент не ваш регион");

                return $this->redirect(['/administration/'.$modelProfile->role=="client_juridical" ? "clientjuridical" : "client".'/client-info', 'id'=>$modelProfile->user_id]);
            }
        }

        $model=Orders::find()->where(['user_id'=>$profile_id, 'id'=>$order_id])->one();
        $dataProvider=new ActiveDataProvider([
            'query'=>\app\models\Invoices::find()->where(['order_id'=>$model->id]),
            'sort'=>[
                'defaultOrder'=>[
                    'created_at'=>SORT_DESC,
                ]
            ],
        ]);
        $dataProvider1=new ActiveDataProvider([
            'query'=>\app\models\Debitor::find()->where(['order_id'=>$model->id, 'profile_id'=>$profile_id]),
            'sort'=>[
                'defaultOrder'=>[
                    'created_at'=>SORT_DESC,
                ]
            ],
        ]);


        if(empty($model))
        {
            Yii::$app->session->setFlash('error', 'Заказ не найдено');
            return $this->redirect(['history-order', 'profile_id'=>$profile_id]);
        }
        $modelForm=new \app\models\Oplata();
        $modelForm->order_itog=$model->sum;
        $modelForm->order_id=$model->id;
        if (Yii::$app->request->isAjax && $modelForm->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($modelForm);
        }
        $PayActions=new \app\models\checkout\PayActions($model);
        if($modelForm->load(Yii::$app->request->post()))
        {
            if(!Yii::$app->user->can('super_admin')){
                if(\app\models\config\Ruxsatnoma::isHuquqRahbariyat() xor !Yii::$app->user->can('IsCourierClient', ['order'=>$modelForm->order_id]) )
                {
                    Yii::$app->session->setFlash('error', 'Это не ваш клиент');
                    return $this->redirect(['/administration/history-order/order-view', 'profile_id'=>$profile_id, 'order_id'=>$order_id]);
                }
            }
            $conn=Yii::$app->db;
            $transaction=$conn->beginTransaction();
            try{
                if(!$PayActions->Tolov($modelForm->pay_sum, $modelForm->method_pay)){
                    $transaction->rollback();
                    Yii::$app->session->setFlash('error', 'Оплата ');
                    return $this->redirect(['/administration/history-order/order-view', 'profile_id'=>$profile_id, 'order_id'=>$order_id]);
                }
                if($modelForm->pay_sum!=$model->sum){
                        if(!$PayActions->Qarzga(
                                $modelForm->pay_sum,
                                $modelForm->debit_sum,
                                $modelForm->debit_date,
                                $modelForm->comment_text
                            )
                        ){
                            $transaction->rollback();
                            Yii::$app->session->setFlash('error', 'Оплата ');
                            return $this->redirect(['/administration/history-order/order-view', 'profile_id'=>$profile_id, 'order_id'=>$order_id]);
                        }
                        if(!$PayActions->SetOrderStatus(
                            Orders::STATUS_ZAKUPKA_DOLG,
                            Orders::STATUS_DELIVERID
                        )
                        ){
                            $transaction->rollback();
                            Yii::$app->session->setFlash('error', 'Оплата ');
                            return $this->redirect(['/administration/history-order/order-view', 'profile_id'=>$profile_id, 'order_id'=>$order_id]);
                        }
                    }else{

                        if(!$PayActions->SetOrderStatus(
                            Orders::STATUS_ZAKUPKA,
                            Orders::STATUS_DELIVERID
                        )
                        ){
                            $transaction->rollback();
                            Yii::$app->session->setFlash('error', 'Оплата ');
                            return $this->redirect(['/administration/history-order/order-view', 'profile_id'=>$profile_id, 'order_id'=>$order_id]);
                        }
                    }
                $transaction->commit();
                Yii::$app->session->setFlash('success', 'Успешно №'.$model->id."");
                return $this->redirect(['/administration/history-order/order-view', 'profile_id'=>$profile_id, 'order_id'=>$order_id]);
            }catch(\Exception $e){
                $transaction->rollback();
                Yii::$app->session->setFlash('error', 'Ошибка что то '.$e);
                return $this->redirect(['/administration/history-order/order-view', 'profile_id'=>$profile_id, 'order_id'=>$order_id]);
            }
        }
        $vernutDolg=new \app\models\checkout\VernutDolg();
        if (Yii::$app->request->isAjax && $vernutDolg->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($vernutDolg);
        }
        if($vernutDolg->load(Yii::$app->request->post())){
           if($PayActions->PayDebit($vernutDolg->debit_summ, $vernutDolg->method_pay)){
               Yii::$app->session->setFlash('success', 'Успешно №'.$model->id."");
               return $this->redirect(['/administration/history-order/order-view', 'profile_id'=>$profile_id, 'order_id'=>$order_id]);
           }else{
               Yii::$app->session->setFlash('error', 'Ошибка что то ');
               return $this->redirect(['/administration/history-order/order-view', 'profile_id'=>$profile_id, 'order_id'=>$order_id]);
           }
        }
        $modelmagazin=Profile::findOne($profile_id);
        return $this->render('oplata', compact( 'model', 'modelmagazin', 'modelForm', 'dataProvider', 'dataProvider1', 'vernutDolg'));
    }
}
