<?php

namespace app\modules\administration\controllers;

use app\models\Images;
use app\models\Productattr;
use Yii;
use app\models\Product;
use app\models\Model;
use app\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
use \app\models\Discount;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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
                        'actions' => ['index', 'view', 'create', 'update'],
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

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
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

    public function actionSlug($slug){
        $model=Product::find()->where(['slug'=>$slug])->one();

        if(!is_null($model))
        {
            return $this->render('view',[
                'model'=>$model,
            ]);
        }else{
            return $this->redirect('/administration/product/index');
        }
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();
        $autocomplement=Productattr::find()->select('attr_name')->groupBy('attr_name')->asArray()->all();
        $autocomplementValue=Productattr::find()->select('attr_value')->groupBy('attr_value')->asArray()->all();


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
                        foreach ($modelDiscount as $modelDiscount) {
                            $modelDiscount->product_id = $model->id;
                            $modelDiscount->date_start = date('Y-m-d',strtotime($modelDiscount->date_start));
                            $modelDiscount->date_end = date('Y-m-d',strtotime($modelDiscount->date_end));
                            if (! ($flag = $modelDiscount->save(false))) {
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
                    if ($flag) {
                        $transaction->commit();
                        Yii::$app->session->setFlash('success', "Товар успешно добавлен");

                        return $this->redirect(['update', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                    var_dump($model->errors);
                    die();
                }
            }
        }
        return $this->render('create', [
            'model' => $model,
            'modelAttr' => $modelAttr,
            'modelDiscount' => $modelDiscount,
            'autocomplement' => $autocomplement,
            'autocomplementValue' => $autocomplementValue,
        ]);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {

        $model = $this->findModel($id);
        
        if(!Yii::$app->user->can('super_admin')){
            if(Yii::$app->user->can('isRegProduct', ['user_id'=>$model->user_id])==false){
                Yii::$app->session->setFlash('error', "Товар не ваш регион");
                return $this->redirect(['index']);
            }
        }
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
                        var_dump($model->errors);
                        die();
                    }


                    if ($flag) {
                        $transaction->commit();
                        Yii::$app->session->setFlash('success', 'Успешно обновление');
                        return $this->redirect(['update', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
            //return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
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

    public function actionSetmain($id_product, $id_img)
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

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model=$this->findModel($id);
        $model->removeImages();//modelga biriktirilgan rasmlarni o'chirish
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
