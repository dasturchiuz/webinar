<?php

namespace app\controllers;

use app\models\ProductAds;
use app\models\Productreviews;
use Yii;
use yii\data\ActiveDataProvider;
use app\models\Product;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use app\models\Model;
use app\models\Productattr;
use app\models\Discount;
use yii\web\UploadedFile;
class ShopController extends \yii\web\Controller
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
                    [
                        'actions'=>['magazin'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
        ];
    }
    public function actionBuy($slug){
        $profile=\app\models\Profile::find()->where(['name_magazin'=>$slug])->one();
        if($profile==null ){
            throw new \yii\web\NotFoundHttpException(404);
        }

        $data_mass=[ 'seller_id'=>$profile->user_id, 'type_ads'=>Product::PRODUCT_TYPEAD_PAKUPAYU];

        //$searchModel = new \app\models\ProductCatSearch();
        //$dataProvider = $searchModel->searchInShop(Yii::$app->request->queryParams, $data_mass);
        $dataProvider=new ActiveDataProvider([
            'query'=>ProductAds::find()->where($data_mass),
            'pagination'=>[
                'pageSize'=>12,
            ],
            'sort'=>['defaultOrder'=>['created_at'=>SORT_DESC]],
        ]);

        return $this->render('buy', compact('dataProvider', 'profile'));
    }
    public function actionSell($slug){
        $profile=\app\models\Profile::find()->where(['name_magazin'=>$slug])->one();
        if($profile==null ){
            throw new \yii\web\NotFoundHttpException(404);
        }

        $data_mass=[ 'seller_id'=>$profile->user_id, 'type_ads'=>Product::PRODUCT_TYPEAD_PRADAYU];

        //$searchModel = new \app\models\ProductCatSearch();
        //$dataProvider = $searchModel->searchInShop(Yii::$app->request->queryParams, $data_mass);
        $dataProvider=new ActiveDataProvider([
            'query'=>ProductAds::find()->where($data_mass),
            'pagination'=>[
                'pageSize'=>12,
            ],
            'sort'=>['defaultOrder'=>['created_at'=>SORT_DESC]],
        ]);

        return $this->render('sell', compact('dataProvider', 'profile'));
    }

    public function actionPro($slug)
    {


        if (!Product::find()->where(['slug' => $slug])->exists()) {
            Yii::$app->session->setFlash('error', Yii::t('app', "Таких товаров не существует"));
            return $this->redirect(['product/']);

        }

        $model = Product::find()->where(['slug' => $slug])->one();



        $dataReviewsProvider = new ActiveDataProvider([
            'query' => $model->getReviews(),
        ]);
        $schot = Product::findOne($model->id);
        $schot->updateCounters(['view_count' => 1]);
        //$schot->save();
        return $this->render('viewProduct', [
            'model' => $model,

        ]);

    }



    //magazinni kursatish
    public function actionMagazin($slug, $category=null){

        $profile=\app\models\Profile::find()->where(['name_magazin'=>$slug])->one();
        if($profile==null ){
            throw new \yii\web\NotFoundHttpException(404);
        }

        $data_mass=['available'=>'yes', 'user_id'=>$profile->user_id];
        if($category!=null){
            if(($data=\app\models\Category::getIdBySlug($category))!=false){
                $data_mass['category_id']=$data;
            }

        }
        $searchModel = new \app\models\ProductCatSearch();
        $dataProvider = $searchModel->searchInShop(Yii::$app->request->queryParams, $data_mass);
//        $dataProvider=new ActiveDataProvider([
//            'query'=>Product::find()->where($data_mass),
//            'pagination'=>[
//                'pageSize'=>12,
//            ],
//            'sort'=>['defaultOrder'=>['created_at'=>SORT_DESC]],
//        ]);

         return $this->render('index', compact('dataProvider', 'profile', 'category', 'searchModel'));
    }










}
