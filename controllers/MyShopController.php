<?php
/**
 * Created by PhpStorm.
 * User: loock
 * Date: 2/24/19
 * Time: 8:30 PM
 */

namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\Product;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use app\models\Model;
use app\models\Productattr;
use app\models\Discount;
use app\models\Orders;
use yii\web\UploadedFile;

class MyShopController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),

                'rules' => [
                    [

                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /*
     * O'zini magaziniga product qushish     *
     */

    public function actionAddProduct(){
        $model = new Product();
        $autocomplement=Productattr::find()->select('attr_name')->groupBy('attr_name')->asArray()->all();
        $autocomplementValue=Productattr::find()->select('attr_value')->groupBy('attr_value')->asArray()->all();
        $model->user_id=Yii::$app->user->identity->getId();
        $model->region_id=Yii::$app->user->identity->getRegionId();


        $modelAttr = [new \app\models\Productattr()];
        $modelDiscount=[new Discount()];
        if ($model->load(Yii::$app->request->post())) {


            $modelAttr = Model::createMultiple(Productattr::classname());
            $modelDiscount = Model::createMultiple(Discount::classname());

            Model::loadMultiple($modelAttr, Yii::$app->request->post());
            Model::loadMultiple($modelDiscount, Yii::$app->request->post());

            // validate all models
            $valid = $model->validate();
            //$valid = Model::validateMultiple($modelImages) && $valid ;//&& Model::validateMultiple($modelAttr);
            $transaction = \Yii::$app->db->beginTransaction();

            if ($valid) {
                try {

                    $model->profile_id=\Yii::$app->user->identity->id;
                    if ($flag = $model->save(false)) {

                        foreach ($modelAttr as $modelattr) {
                            $modelattr->product_id = $model->id;
                            if (! ($flag = $modelattr->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }

                    }

                    $model->product_images=UploadedFile::getInstances($model, 'product_images');


                    if( !$model->uploadgallery())
                    {
                        $transaction->rollBack();
                        var_dump($model->errors);
                        die();
                    }
                    if($model->type_product==Product::PRODUCT_TYPE_DILLER || $model->type_product==Product::PRODUCT_TYPE_ALL){
                        $modelAds=new \app\models\ProductAds();
                        $modelAds->seller_id=$model->user_id;
                        $modelAds->product_id=$model->id;
                        $modelAds->type_ads=$model->type_ads;
                        $modelAds->price_ads=$model->price_ads;
                        if (! ($flag = $modelAds->save(false))) {
                            $transaction->rollBack();

                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        Yii::$app->session->setFlash('success', "Товар успешно добавлен");

                        return $this->redirect(['/my-shop/my-products']);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }
        return $this->render('add_product', [
            'model' => $model,
            'modelAttr' => $modelAttr,
            'modelDiscount' => $modelDiscount,
            'autocomplement' => $autocomplement,
            'autocomplementValue' => $autocomplementValue,
        ]);
    }


    //foydalanuvchini maxsulotlarini qo'shish
    public function actionMyProducts(){

        $searchModel = new \app\models\ProductSearch();
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider = $searchModel->searchByUserId(Yii::$app->user->identity->id);
        return $this->render('products', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionEditProduct($product_id){
        if(!Yii::$app->user->can('IsUserProduct', ['product_id'=>$product_id])){
            Yii::$app->session->setFlash('error', 'Sizning tavaringiz emas');
            return $this->redirect(Yii::$app->request->referrer);
        }

        $model = Product::findOne($product_id);
        $modelAds=\app\models\ProductAds::find()->where(['product_id'=>$model->id, 'seller_id'=>Yii::$app->user->identity->id])->one();

        $model->type_ads=!empty($modelAds) ? $modelAds->type_ads : 0;

        $autocomplement=Productattr::find()->select('attr_name')->groupBy('attr_name')->asArray()->all();
        $autocomplementValue=Productattr::find()->select('attr_value')->groupBy('attr_value')->asArray()->all();

        $modelImages = [new \app\models\Productimages()];

        $modelAttr = $model->attrproducts;
        $modelDiscounts = $model->discounts;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //atributni idlarini solishtirayapti
            $oldIDS=ArrayHelper::map($modelAttr, 'id', 'id');
            //atributni idlarini solishtirayapti
            $oldIDS_skidka=ArrayHelper::map($modelDiscounts, 'id', 'id');

            //skidkani modelni olish
            $modelDiscounts = Model::createMultiple(Discount::classname(), $modelDiscounts);
            Model::loadMultiple($modelDiscounts, Yii::$app->request->post());
            //attributlarni modeli
            $modelAttr = Model::createMultiple(Productattr::classname(), $modelAttr);
            Model::loadMultiple($modelAttr, Yii::$app->request->post());
            $valid = $model->validate();

            //atributlarni o'chirilgan idlarini topish
            $deletedIDs = array_diff($oldIDS, array_filter(ArrayHelper::map($modelAttr, 'id', 'id')));

            //skidkalarni o'chirilgan idlarini topish
            $deletedIDs_SKIDKA = array_diff($oldIDS_skidka, array_filter(ArrayHelper::map($modelDiscounts, 'id', 'id')));
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    //$model->profile_id=\Yii::$app->user->identity->id;
                    if ($flag = $model->save(false)) {
                        //atribut modelidan o'chirilgan id larni barchasin i o'chirib tashlayapmiz
                        if(!empty($deletedIDs))
                        {
                            Productattr::deleteAll(['id'=>$deletedIDs]);
                        }

                        //skidka modelidan o'chirilgan skidkalarni olib tashlayapmiz
//                        if(!empty($deletedIDs_SKIDKA))
//                        {
//                            Discount::deleteAll(['id'=>$deletedIDs_SKIDKA]);
//                        }
                        //attribut modelida ]o'zgarishlarni saqlayapmiz
                        foreach ($modelAttr as $modelattr) {
                            $modelattr->product_id = $model->id;

                            if (! ($flag = $modelattr->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }

                        if($model->type_product==Product::PRODUCT_TYPE_DILLER || $model->type_product==Product::PRODUCT_TYPE_ALL ){

                            if(!empty($modelAds)){
                                $modelAds->type_ads=$model->type_ads;
                                $modelAds->price_ads=$model->price_ads;
                            }else{
                                $modelAds=new \app\models\ProductAds();
                                $modelAds->seller_id=$model->user_id;
                                $modelAds->product_id=$model->id;
                                $modelAds->type_ads=$model->type_ads;
                                $modelAds->price_ads=$model->price_ads;
                            }

                            if (! ($flag = $modelAds->save(false))) {
                                $transaction->rollBack();

                            }
                        }else{
                            $modelAds=\app\models\ProductAds::find()->where(['product_id'=>$model->id, 'seller_id'=>Yii::$app->user->identity->id])->one();
                            if(!empty($modelAds))
                                $modelAds->delete();
                        }

                        //skidka modelida ]o'zgarishlarni saqlayapmiz
                        if(count($modelDiscounts)>0){
                            foreach ($modelDiscounts as $modelDISCOUNT) {
                                if(!empty($modelDISCOUNT->price_procent)){
                                    $modelDISCOUNT->product_id = $model->id;
                                    $modelDISCOUNT->date_start = date('Y-m-d',strtotime($modelDISCOUNT->date_start));
                                    $modelDISCOUNT->date_end = date('Y-m-d',strtotime($modelDISCOUNT->date_end));
                                    if (! ($flag = $modelDISCOUNT->save(false))) {
                                        $transaction->rollBack();
                                        break;
                                    }
                                }
                            }
                        }
                    }
                    $model->product_images=UploadedFile::getInstances($model, 'product_images');

                    if( !$model->uploadgallery())
                    {
                        $transaction->rollBack();
                    }

                    if ($flag) {

                        $transaction->commit();
                        Yii::$app->session->setFlash('success', 'Успешно обновление');
                        return $this->redirect(['/my-shop/my-products']);
                    }
                } catch (Exception $e) {
                    die();
                    $transaction->rollBack();
                    Yii::$app->session->setFlash('error', 'Ошибка');
                    return $this->redirect(['/my-shop/my-products']);
                }
            }
        }

        return $this->render('add_product', [
            'model' => $model,
            'autocomplement' => $autocomplement,
            'autocomplementValue' => $autocomplementValue,
            'modelAttr' =>  (empty($modelAttr)) ? [new Productattr()] : $modelAttr,
            'modelDiscount' =>  (empty($modelDiscounts)) ? [new Discount()] : $modelDiscounts,
        ]);
    }

    //product rasmini ajax orqali uchirish
    public function actionDeleteimg($id_product, $id_img)
    {
        $prdcts = Product::find()
            ->where(['id' => $id_product])
            ->one();

        $images = $prdcts->getImages();
        foreach($images as $img){
            if($img->id==$id_img){
                $prdcts->removeImage($img);
            }
        }
        $success=true;
        return json_encode($success);
    }
    //product rasmini ajax orqali uchirish

    public function actionSetmainimage($id_product, $id_img)
    {
        $prdcts = Product::find()
            ->where(['id' => $id_product])
            ->one();

        $images = $prdcts->getImages();
        foreach($images as $img){
            if($img->id==$id_img){
                $prdcts->setMainImage($img);
            }
        }
        $success=true;
        return json_encode($success);
    }


    //orderlar

    public function actionOrders()
    {
        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('error', 'Предупреждение: у вас нет разрешения!');
            return $this->goHome();
        }

        $orders=new ActiveDataProvider([
            'query'=>Orders::find()->where(['user_id'=>Yii::$app->user->identity->id, 'status'=>Orders::STATUS_NEW]),
            'sort'=>[
                'defaultOrder'=>[
                    'created_at'=>SORT_DESC,
                ],
            ],
            'pagination'=>[
                'pageSize'=>20,
            ],
        ]);
        return $this->render('orders', compact('orders'));
    }
    //istoriya pokupok
    public function actionHistoryShopping(){
        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('error', 'Предупреждение: у вас нет разрешения!');
            return $this->goHome();
        }

        $orders=new ActiveDataProvider([
            'query'=>Orders::find()->where(['user_id'=>Yii::$app->user->identity->id])->andWhere(['or', ['status'=>Orders::STATUS_ZAKUPKA], ['status'=>Orders::STATUS_ZAKUPKA_OTKAZ]]),
            'sort'=>[
                'defaultOrder'=>[
                    'created_at'=>SORT_DESC,
                ],
            ],
            'pagination'=>[
                'pageSize'=>20,
            ],
        ]);
        return $this->render('history_order', compact('orders'));
    }
    //Istoriya prodaja
    public function actionHistorySales(){
        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('error', 'Предупреждение: у вас нет разрешения!');
            return $this->goHome();
        }

        $orders=new ActiveDataProvider([
            'query'=>Orders::find()->where(['seller_id'=>Yii::$app->user->identity->id])->andWhere(['or', ['status'=>Orders::STATUS_ZAKUPKA], ['status'=>Orders::STATUS_ZAKUPKA_OTKAZ]]),
            'sort'=>[
                'defaultOrder'=>[
                    'created_at'=>SORT_DESC,
                ],
            ],
            'pagination'=>[
                'pageSize'=>20,
            ],
        ]);
        return $this->render('history_sales', compact('orders'));
    }


    //qabul qilingan zakazlar
    public function actionAcceptedOrders()
    {
        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('error', 'Предупреждение: у вас нет разрешения!');
            return $this->goHome();
        }

        $orders=new ActiveDataProvider([
            'query'=>Orders::find()->where(['seller_id'=>Yii::$app->user->identity->id, 'status'=>Orders::STATUS_NEW]),
            'sort'=>[
                'defaultOrder'=>[
                    'created_at'=>SORT_DESC,
                ],
            ],
            'pagination'=>[
                'pageSize'=>20,
            ],
        ]);
        return $this->render('acceptedorders', compact('orders'));
    }


    //mening zakazlarim
    public function actionOrderview($id){

        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('error', 'Предупреждение: у вас нет разрешения!');
            return $this->goHome();
        }
        $order=Orders::findOne($id);

        if (!$order) {
            Yii::$app->session->setFlash('error', 'Этот заказ отсутствует!');
            return $this->redirect(['/account/orders']);
        }

        if(!Yii::$app->user->can('IsUserOrder', ['order_id'=>$order->id])){
            Yii::$app->session->setFlash('error', 'Этот заказ не ваш');
            return $this->redirect(['/account/orders']);
        }


        $order->is_read=1;
        $order->save(false);
        $model=$order;
        $modelmagazin=$order->profile;
        return $this->render('orderview', compact('order', 'model', 'modelmagazin'));
    }

    //status zakaz otdal zakaz annulirovat zakaz
    public function  actionStatusOrder($order_id, $status){

        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('error', 'Предупреждение: у вас нет разрешения!');
            return $this->goHome();
        }

        $order=Orders::findOne($order_id);
        if (!$order) {
            Yii::$app->session->setFlash('error', 'Этот заказ отсутствует!');
            return $this->redirect(['/my-shop/accepted-orders']);
        }

        if( $order->status==\app\models\Orders::STATUS_ZAKUPKA || $order->status==\app\models\Orders::STATUS_ZAKUPKA_OTKAZ){
            Yii::$app->session->setFlash('error', 'Статус заказа был изменен заранее');
            return $this->redirect(['/account/accepted-order-view', 'id'=>$order_id]);
        }

        if(!Yii::$app->user->can('IsSellerOrder', ['order_id'=>$order->id])){
            Yii::$app->session->setFlash('error', 'Этот заказ не ваш');
            return $this->redirect(['/my-shop/accepted-orders']);
        }
        $order->status=$status==1 ? \app\models\Orders::STATUS_ZAKUPKA : \app\models\Orders::STATUS_ZAKUPKA_OTKAZ;
        $order->save(false);
        Yii::$app->session->setFlash('success', 'Успешно');
        return $this->redirect(['/my-shop/accepted-order-view', 'id'=>$order_id]);
    }



    //menga tushgan zakazni ko'ish'
    public function actionAcceptedOrderView($id){

        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('error', 'Предупреждение: у вас нет разрешения!');
            return $this->goHome();
        }

        $order=Orders::findOne($id);
        if (!$order) {
            Yii::$app->session->setFlash('error', 'Этот заказ отсутствует!');
            return $this->redirect(['/my-shop/accepted-orders']);
        }

        if(!Yii::$app->user->can('IsSellerOrder', ['order_id'=>$order->id])){
            Yii::$app->session->setFlash('error', 'Этот заказ не ваш');
            return $this->redirect(['/my-shop/accepted-orders']);
        }
        $order->is_read=1;
        $order->save(false);
        $model=$order;
        return $this->render('ao_view', compact( 'model'));
    }

    //habarlarni o'qish

    public function actionMessages(){
        return $this->render('messages');
    }

    public function actionReadMessages($id, $chat_room){
        return $this->render('viewmessage', compact('id', 'chat_room'));
    }

    public function actionSendMessages($seller_id){
        return $this->render('sendmessage', compact('seller_id'));
    }


}