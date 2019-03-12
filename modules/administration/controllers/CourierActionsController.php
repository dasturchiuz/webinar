<?php
namespace app\modules\administration\controllers;

use Yii;
use app\models\Profile;
use yii\base\Model;
use yii\filters\AccessControl;
class CourierActionsController extends \yii\web\Controller{

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
                        'actions'=>['load-products','return-products'],
                        'roles'=>['сouriers'],
                    ]
                ],
            ],
        ];
    }

    //*******************************Manager********************************************************///////
    //bugun zagruzka qilinishi kere bulgan courierlar
    public function actionTodayLoad(){

        $searchModel=new \app\models\courieractions\SearchModel();
        $region_id=Yii::$app->user->identity->getRegionId();
        $dataProvider=$searchModel->search($region_id, date('Y-m-d'));
        if(\app\models\config\Ruxsatnoma::isSuper()){
            $dataProvider=$searchModel->searchSuperAdmin(date('Y-m-d'));
        }
        return $this->render('loadtoday', compact('dataProvider'));
    }

    //bugun zagruzka qilinishi kere bulgan courierlar
    public function actionCourier($id)
    {
        $zagruzka=true;
        $model = Profile::findOne($id);
        $searchModel = new \app\models\courieractions\SearchModel();
        $dataProvider = $searchModel->searchProfileOrders($model->user_id, date('Y-m-d'));
        $order_ids = [];
        foreach ($dataProvider->getModels() as $item) {
            $order_ids[] = $item->id;
        }

        //agar model form bush bulsa bugungi kunni maxsulotlarini chiqaradi
        $modelForm = \app\models\courieractions\CourierLoadedProducts::find()->where(['courier_id' => $model->user_id])->all();
        if(empty($modelForm)){
            $zagruzka=false;
            if (Yii::$app->request->post('CourierLoadedProducts', []) != null) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    foreach (Yii::$app->request->post('CourierLoadedProducts', []) as $postItem) {
                        $curier = new \app\models\courieractions\CourierLoadedProducts($postItem);
                        if($curier->qty_loaded>$curier->amount){
                            $transaction->rollBack();
                            Yii::$app->session->setFlash('error', 'Ошибка! Код тавар: '.$curier->product_id.' К загрузки: '.$curier->qty.' Вы загрузили: '.$curier->qty_loaded." В складе:". $curier->amount);
                            return $this->redirect(['/administration/courier-actions/courier', 'id'=>$id]);
                        }
                        $curier->courier_id = $model->user_id;
                        $curier->save();
                        $product=\app\models\Product::findOne($curier->product_id);
                        $product->amount=$product->amount-$curier->qty_loaded;
                        $product->save(false);
                    }
                    $transaction->commit();
                    Yii::$app->session->setFlash('success', 'Успешно загрузил  в курьир');
                    return $this->redirect(['/administration/courier-actions/courier', 'id'=>$id]);
                    // actions to do on success (redirect, alert, etc.)
                } catch (Exception $e) {
                    $transaction->rollBack();
                    // other actions to perform on fail (redirect, alert, etc.)
                }
            }

            $command = Yii::$app->db->createCommand("SELECT o.id, o.product_id, o.name, SUM(o.summ_item) as summa, SUM(o.qty_item) as qty, o.price , p.amount FROM order_item o LEFT JOIN product p ON o.product_id=p.id WHERE o.order_id IN(".join(",", $order_ids).") GROUP BY o.product_id");
            $orderitems= $command->queryAll();

           // $orderitems = \app\models\Orderitem::find()->select("id, product_id, name, SUM(summ_item) as summa, SUM(qty_item) as qty ")->where(['order_id' => $order_ids])->groupby("product_id")->asArray()->all();
            foreach ($orderitems as $itemOrder) {
                $curier = new \app\models\courieractions\CourierLoadedProducts();
                $curier->qty_loaded = 0;
                $curier->prname = $itemOrder['name'];
                $curier->qty = $itemOrder['qty'];
                $curier->product_id = $itemOrder['product_id'];
                $curier->courier_id = $id;
                $curier->amount = $itemOrder['amount'];
                $curier->price_item = $itemOrder['price'];
                $curier->product_price = $itemOrder['summa'];
                $modelForm[] = $curier;
            }
        }
//        elseif(Model::loadMultiple($modelForm, Yii::$app->request->post())) {
//
//            $transaction = Yii::$app->db->beginTransaction();
//            try {
//                foreach ($modelForm as $postItem) {
//                    $postItem->status=\app\models\courieractions\CourierLoadedProducts::STATUS_NEW;
//                    $postItem->save();
//                }
//                $transaction->commit();
//                Yii::$app->session->setFlash('success', 'Успешно изменен');
//                return $this->redirect(['/administration/courier-actions/courier', 'id'=>$id]);
//                // actions to do on success (redirect, alert, etc.)
//            } catch (Exception $e) {
//                $transaction->rollBack();
//                Yii::$app->session->setFlash('error', 'Повторите еще раз');
//                return $this->redirect(['/administration/courier-actions/courier', 'id'=>$id]);
//                // other actions to perform on fail (redirect, alert, etc.)
//            }
//        }
        return $this->render('courier', compact('model', 'dataProvider', 'modelForm', 'zagruzka'));
    }
    //bugun zagruzka qilinishi kere bulgan courierlar

    public function actionCourierReturn($id)
    {
        $zagruzka=true;
        $model = Profile::findOne($id);
        $searchModel = new \app\models\courieractions\SearchModel();

        //agar model form bush bulsa bugungi kunni maxsulotlarini chiqaradi
        $modelForm = \app\models\courieractions\CourierLoadedProducts::find()->where(['courier_id' => $model->user_id])->all();
        if(Model::loadMultiple($modelForm, Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                foreach ($modelForm as $postItem) {
                    if($postItem->status!=\app\models\courieractions\CourierLoadedProducts::STATUS_COMPLETED){
                        Yii::$app->session->setFlash('error', 'Курьир не закончил');
                        $transaction->rollBack();
                        return $this->redirect(['/administration/courier-actions/courier-return', 'id'=>$id]);
                    }
                    if($postItem->qty_loaded>$postItem->remnant){
                        $product=\app\models\Product::findOne($postItem->product);
                        $product->amount=$product->amount+($postItem->qty_loaded-$postItem->remnant);
                        $product->save(false);
                    }
                    $postItem->delete();
                }
                $transaction->commit();
                Yii::$app->session->setFlash('success', 'Успешно изменен');
                return $this->redirect(['/administration/courier-actions/courier-return', 'id'=>$id]);
                // actions to do on success (redirect, alert, etc.)
            } catch (Exception $e) {
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', 'Повторите еще раз');
                return $this->redirect(['/administration/courier-actions/courier-return', 'id'=>$id]);
                // other actions to perform on fail (redirect, alert, etc.)
            }
        }
        return $this->render('return', compact('model', 'modelForm', 'zagruzka'));
    }



    //qaytarib olinishi kere bulgan courierlar
    public function actionTodayReturn(){
        $searchModel=new \app\models\courieractions\SearchModel();
        $region_id=Yii::$app->user->identity->getRegionId();

        $dataProvider=$searchModel->seachReturnProfiles($region_id);
         if(\app\models\config\Ruxsatnoma::isSuper()){
             $dataProvider=$searchModel->seachReturnProfilesSuperAdmin();
         }
        return $this->render('loadreturn', compact('dataProvider'));
    }




    //*******************************KURIERNI AMALLARI**************************//////
    public function actionLoadProducts(){
        $id=Yii::$app->user->identity->id;
        $model = Profile::findOne($id);
        $searchModel = new \app\models\courieractions\SearchModel();
        $dataProvider = $searchModel->searchProfileOrders($model->user_id, date('Y-m-d'));
        $order_ids = [];
        foreach ($dataProvider->getModels() as $item) {
            $order_ids[] = $item->id;
        }
        //agar model form bush bulsa bugungi kunni maxsulotlarini chiqaradi
        $modelForm = \app\models\courieractions\CourierLoadedProducts::find()->where(['courier_id' => $model->user_id])->all();
        if(empty($modelForm) && count($order_ids)>0){
            $command = Yii::$app->db->createCommand("SELECT o.id, o.product_id, o.name, SUM(o.summ_item) as summa, SUM(o.qty_item) as qty, o.price , p.amount FROM order_item o LEFT JOIN product p ON o.product_id=p.id WHERE o.order_id IN(".join(",", $order_ids).") GROUP BY o.product_id");
            $orderitems= $command->queryAll();
            if(!empty($orderitems)){
                foreach ($orderitems as $itemOrder) {
                    $curier = new \app\models\courieractions\CourierLoadedProducts();
                    $curier->qty_loaded = 0;
                    $curier->prname = $itemOrder['name'];
                    $curier->qty = $itemOrder['qty'];
                    $curier->product_id = $itemOrder['product_id'];
                    $curier->courier_id = $id;
                    $curier->product_price = $itemOrder['summa'];
                    $modelForm[] = $curier;
                }
            }

        }elseif(Model::loadMultiple($modelForm, Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                foreach ($modelForm as $postItem) {
                    $postItem->status=\app\models\courieractions\CourierLoadedProducts::STATUS_ACCEPTED;
                    if($postItem->qty_loaded < $postItem->remnant){
                        $transaction->rollBack();
                        Yii::$app->session->setFlash('error', 'Ошибка! Код тавар: '.$postItem->product_id.' К загрузки: '.$postItem->qty.' Вы загрузили: '.$postItem->qty_loaded." В складе:". $postItem->amount);
                        return $this->redirect(['/administration/courier-actions/load-products', 'id'=>$id]);
                    }
                    if($postItem->status==\app\models\courieractions\CourierLoadedProducts::STATUS_COMPLETED){
                        $transaction->rollBack();
                        Yii::$app->session->setFlash('error', 'Ошибка! Uje zakrili tavari');
                        return $this->redirect(['/administration/courier-actions/load-products', 'id'=>$id]);
                    }
                    $postItem->save();
                }
                $transaction->commit();
                Yii::$app->session->setFlash('success', 'Успешно принял');
                return $this->redirect(['/administration/courier-actions/load-products']);
                // actions to do on success (redirect, alert, etc.)
            } catch (Exception $e) {
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', 'Повторите еще раз');
                return $this->redirect(['/administration/courier-actions/courier']);
                // other actions to perform on fail (redirect, alert, etc.)
            }
        }
        return $this->render('courierload', compact('model', 'dataProvider', 'modelForm'));
    }

    public function actionReturnProducts(){
        $id=Yii::$app->user->identity->id;
        $model = Profile::findOne($id);
        $searchModel = new \app\models\courieractions\SearchModel();
        $dataProvider = $searchModel->searchProfileOrders($model->user_id, date('Y-m-d'));
        $order_ids = [];
        foreach ($dataProvider->getModels() as $item) {
            $order_ids[] = $item->id;
        }
        //agar model form bush bulsa bugungi kunni maxsulotlarini chiqaradi
        $modelForm = \app\models\courieractions\CourierLoadedProducts::find()->where(['courier_id' => $model->user_id])->all();
        if(empty($modelForm) && count($order_ids)>0){
            $command = Yii::$app->db->createCommand("SELECT o.id, o.product_id, o.name, SUM(o.summ_item) as summa, SUM(o.qty_item) as qty, o.price , p.amount FROM order_item o LEFT JOIN product p ON o.product_id=p.id WHERE o.order_id IN(".join(",", $order_ids).") GROUP BY o.product_id");
            $orderitems= $command->queryAll();
            foreach ($orderitems as $itemOrder) {
                $curier = new \app\models\courieractions\CourierLoadedProducts();
                $curier->qty_loaded = 0;
                $curier->prname = $itemOrder['name'];
                $curier->qty = $itemOrder['qty'];
                $curier->product_id = $itemOrder['product_id'];
                $curier->courier_id = $id;
                $curier->product_price = $itemOrder['summa'];
                $modelForm[] = $curier;
            }
        }elseif(Model::loadMultiple($modelForm, Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                foreach ($modelForm as $postItem) {
                    $postItem->status=\app\models\courieractions\CourierLoadedProducts::STATUS_COMPLETED;
                    $postItem->save();
                }
                $transaction->commit();
                Yii::$app->session->setFlash('success', 'Успешно принял');
                return $this->redirect(['/administration/courier-actions/return-products']);
                // actions to do on success (redirect, alert, etc.)
            } catch (Exception $e) {
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', 'Повторите еще раз');
                return $this->redirect(['/administration/courier-actions/return-products']);
                // other actions to perform on fail (redirect, alert, etc.)
            }
        }
        return $this->render('courierreturn', compact('model', 'dataProvider', 'modelForm'));
    }
}