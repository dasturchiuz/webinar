<?php

namespace app\modules\administration\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Profile;
use app\models\Orders;
use app\models\ProfileWeekSearch;
use yii\filters\AccessControl;
use yii\db\Query;
use yii\data\ActiveDataProvider;
use app\models\CommentProfile;

/**
 * DeliveryMethodController implements the CRUD actions for DeliveryMethod model.
 */
class DeliveryController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors(){
        return [
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




    public function actionAll()
    {
        $model=new \yii\base\DynamicModel([
            'order_id', 'comment_text', 'date'
        ]);
        $model->addRule(['comment_text', 'date', ], 'required');
        $model->addRule(['order_id'], 'required', ['message'=>'Вы не выбрали заказ']);

        if($model->load(Yii::$app->request->post()))
        {

            $order=Orders::findOne($model->order_id);
            if(!\app\models\config\Ruxsatnoma::isHuquqObshe())
            {
                if(Yii::$app->user->can('IsCourierClient', ['order'=>$model->order_id]) == false )
                {
                    Yii::$app->session->setFlash('success', 'Это не ваш клиент');
                    return $this->redirect(['/administration/delivery/all']);
                }
            }
            if(count($order) != 0){
                $conn=Yii::$app->db;
                $transaction=$conn->beginTransaction();
                try{
                    $order->delivery_date=$model->date;
                    $order->save(false);
                    $comment=new CommentProfile();
                    $comment->profile_id=$order->user_id;
                    $comment->com_text='№'.$order->id." Время дату: ".$order->delivery_date." <br>".$model->comment_text;
                    $comment->save(false);
                    $transaction->commit();
                }catch(\Exception $e){
                    $transaction->rollback();
                }

                Yii::$app->session->setFlash('success', 'Успешно №'.$order->id." Время дату: ".$order->delivery_date);
                return $this->redirect(Yii::$app->request->referrer);
            }else{
                Yii::$app->session->setFlash('error', 'Заказ не существует');
                return $this->redirect(Yii::$app->request->referrer);
            }
        }
        $searchModel = new ProfileWeekSearch(); //
        //$dataProvider = $searchModel->search(Yii::$app->user->getId(), $week_num);
        if(\app\models\config\Ruxsatnoma::isHuquqObshe()){
            $dataProvider=$searchModel->searchallByRegion(Yii::$app->user->identity->getRegionId(), 0);

        }else{
            $dataProvider=$searchModel->searchall(Yii::$app->user->getId(), 0);
        }

//
        return $this->render('all', compact('dataProvider', 'model'));
    }



    public function actionToday()
    {
        $model=new \yii\base\DynamicModel([
            'order_id', 'comment_text', 'date'
        ]);
        $model->addRule(['comment_text', 'date', ], 'required');
        $model->addRule(['order_id'], 'required', ['message'=>'Вы не виберил заказ']);

        if($model->load(Yii::$app->request->post()))
        {

            $order=Orders::findOne($model->order_id);
            if(!\app\models\config\Ruxsatnoma::isHuquqObshe())
            {
                if(Yii::$app->user->can('IsCourierClient', ['order'=>$model->order_id]) == false )
                {
                    Yii::$app->session->setFlash('error', 'Это не ваш клиент');
                    return $this->redirect(['/administration/delivery/all']);
                }
            }

            if(count($order) != 0){
                $conn=Yii::$app->db;
                $transaction=$conn->beginTransaction();
                try{
                    $order->delivery_date=$model->date;
                    $order->save(false);
                    $comment=new CommentProfile();
                    $comment->profile_id=$order->user_id;
                    $comment->com_text='№'.$order->id." Время дату: ".$order->delivery_date." <br>".$model->comment_text;
                    $comment->save(false);
                    $transaction->commit();
                }catch(\Exception $e){
                    $transaction->rollback();
                }

                Yii::$app->session->setFlash('success', 'Успешно №'.$order->id." Время дату: ".$order->delivery_date);
                return $this->redirect(Yii::$app->request->referrer);
            }else{
                Yii::$app->session->setFlash('error', 'Заказ не существует');
                return $this->redirect(Yii::$app->request->referrer);
            }
        }
        $searchModel = new ProfileWeekSearch(); //
        if(\app\models\config\Ruxsatnoma::isHuquqObshe()){
            $dataProvider=$searchModel->searchAdminToday(Yii::$app->user->identity->getRegionId(), 0, date('Y-m-d'));

        }else{
            //$dataProvider = $searchModel->search(Yii::$app->user->getId(), $week_num);
            $dataProvider=$searchModel->searchShart(Yii::$app->user->getId(), 0, date('Y-m-d'));
        }



//
        return $this->render('segodniya', compact('dataProvider', 'model'));
    }

    public function actionTomorrow()
    {
        $model=new \yii\base\DynamicModel([
            'order_id', 'comment_text', 'date'
        ]);
        $model->addRule(['comment_text', 'date', ], 'required');
        $model->addRule(['order_id'], 'required', ['message'=>'Вы не виберил заказ']);

        if($model->load(Yii::$app->request->post()))
        {

            $order=Orders::findOne($model->order_id);
            if(!\app\models\config\Ruxsatnoma::isHuquqObshe())
            {
                if(Yii::$app->user->can('IsCourierClient', ['order'=>$model->order_id]) == false )
                {
                    Yii::$app->session->setFlash('error', 'Это не ваш клиент');
                    return $this->redirect(['/administration/delivery/all']);
                }
            }

            if(count($order) != 0){
                $conn=Yii::$app->db;
                $transaction=$conn->beginTransaction();
                try{
                    $order->delivery_date=$model->date;
                    $order->save(false);
                    $comment=new CommentProfile();
                    $comment->profile_id=$order->user_id;
                    $comment->com_text='№'.$order->id." Время дату: ".$order->delivery_date." <br>".$model->comment_text;
                    $comment->save(false);
                    $transaction->commit();
                }catch(\Exception $e){
                    $transaction->rollback();
                }

                Yii::$app->session->setFlash('success', 'Успешно №'.$order->id." Время дату: ".$order->delivery_date);
                return $this->redirect(Yii::$app->request->referrer);
            }else{
                Yii::$app->session->setFlash('error', 'Заказ не существует');
                return $this->redirect(Yii::$app->request->referrer);
            }
        }
        $searchModel = new ProfileWeekSearch(); //
        if(\app\models\config\Ruxsatnoma::isHuquqObshe()){
            $dataProvider=$searchModel->searchShartAdmin(Yii::$app->user->identity->getRegionId(), 0, date('Y-m-d',strtotime(date('Y-m-d')." + 1 DAY")));


        }else{
            //$dataProvider = $searchModel->search(Yii::$app->user->getId(), $week_num);
            $dataProvider=$searchModel->searchShart(Yii::$app->user->getId(), 0, date('Y-m-d',strtotime(date('Y-m-d')." + 1 DAY")));
        }

//
        return $this->render('zavtra', compact('dataProvider', 'model'));
    }

    public function actionDeliverTomorrow($order_id)
    {
        $order=Orders::findOne($order_id);
        if(empty($order))
        {
            Yii::$app->session->setFlash('success', 'Заказ не существует');
            return $this->redirect(['/administration/delivery/today']);
        }

        if(!\app\models\config\Ruxsatnoma::isHuquqObshe())
        {
            if(Yii::$app->user->can('IsCourierClient', ['order'=>$order->id]) == false)
            {
                Yii::$app->session->setFlash('error', 'Это не ваш клиент');
                return $this->redirect(['/administration/delivery/today']);
            }
        }


        $order->delivery_date=date('Y-m-d', strtotime(date('Y-m-d')." + 1 DAY"));
        if($order->save(false))
        {
            Yii::$app->session->setFlash('success', 'Успешно №'.$order->id." Время дату: ".$order->delivery_date);
            return $this->redirect(['/administration/delivery/today']);
        }else{
            Yii::$app->session->setFlash('error', 'Не обновлено');
            return $this->redirect(['/administration/delivery/today']);
        }
    }

    public function actionDelivered()
    {
        $searchModel = new ProfileWeekSearch();
        if(\app\models\config\Ruxsatnoma::isHuquqObshe()){
            $dataProvider=$searchModel->searchShartTodayAdm(Yii::$app->user->identity->getRegionId(), 1, date('Y-m-d'));
        }else{
            $dataProvider=$searchModel->searchShartToday(Yii::$app->user->getId(), 1, date('Y-m-d'));
        }

        return $this->render('delivered', compact('dataProvider'));
    }





}
