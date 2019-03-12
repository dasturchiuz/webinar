<?php

namespace app\controllers;

use app\models\Category;
use app\models\Productreviews;
use Yii;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;
use app\models\Product;

class ProductController extends \yii\web\Controller
{
    public function actionIndex()
    {
//        $dataprovider = new ActiveDataProvider([
//            'query' => Product::find()->where(['available' => 'yes'])->andFilterWhere(['or', ['type_product' => Product::PRODUCT_TYPE_SELLER], ['type_product' => Product::PRODUCT_TYPE_ALL]]),
//            'pagination' => [
//                //'pageSize'=>12,
//                'pageParam' => 'page',
//                'defaultPageSize' => 12,
//                'forcePageParam' => false,
//            ],
//            'sort' => ['defaultOrder' => ['created_at' => SORT_DESC]],
//        ]);
        $searchModel = new \app\models\ProductCatSearch();
        $dataprovider = $searchModel->searchIndex(Yii::$app->request->queryParams);
        //$brand = Product::find()->where(['available' => 'yes'])->groupBy('manufacturer_id')->all();
        //$products=\app\models\Product::find()->limit(12)->all();
        return $this->render('index', [
            'dataProvider' => $dataprovider,
            'searchModel' => $searchModel,
        ]);
    }

    public function actionCategory($slug)
    {
        if (!Category::find()->where(['slug' => $slug])->exists()) {
            Yii::$app->session->setFlash('error', Yii::t('app', "Таких категории не существует"));
            return $this->redirect(['product/']);

        }
        $category = Category::find()->where(['slug' => $slug])->one();
        $listCategorySub = Category::find()->where(['parent_id' => $category->id])->asArray()->all();
        $all_sub_category_id = \app\models\Category::getCategoryids($category->id);
        if ($category->parent_id != null) {
            $category_list = Category::find()->where(['parent_id' => $category->parent_id])->asArray()->all();
            //$category_list = Category::findBySql("SELECT ct.name, ct.slug, COUNT(pr.id) as soni FROM category ct LEFT JOIN product pr ON pr.category_id=ct.id WHERE ct.parent_id=" . $category->parent_id . " GROUP BY ct.id")->asArray()->all();
        } else {
            $category_list = Category::findBySql("SELECT ct.name, ct.slug, (NULL) as soni FROM category ct LEFT JOIN product pr ON pr.category_id=ct.id WHERE ct.parent_id IS NULL    GROUP BY ct.id")->asArray()->all();
        }
        $brand = Product::find()->where(['category_id' => $all_sub_category_id, 'available' => 'yes'])->groupBy('manufacturer_id')->all();

        $searchModel = new \app\models\ProductCatSearch();
        //Yii::$app->request->queryParams['ids']=$all_sub_category_id;
        $dataprovider = $searchModel->search(Yii::$app->request->queryParams, $all_sub_category_id);


        return $this->render('cat', [
            'dataProvider' => $dataprovider,
            'searchModel' => $searchModel,
            'listCategory' => $category_list,
            'category' => $category,
            'listCategorySub' => $listCategorySub,
            'brand' => $brand
        ]);
    }

    public function actionSearch($keyword = null)
    {
        if (!strlen(trim($keyword)) >= 3) {
            Yii::$app->session->setFlash('error', Yii::t('app', "Не 3 "));
            return $this->redirect(Yii::$app->homeUrl);
        }

        if (trim($keyword)) {
            $keyword = trim($keyword);
            $searchLog = new \app\models\product\SearchLog([
                'session_id' => Yii::$app->session->id != null ? Yii::$app->session->id : "",
                'user_id' => isset(Yii::$app->user->id) ? Yii::$app->user->id : 0,
                'keyword' => $keyword,
                'ip' => Yii::$app->request->userIP,
            ]);
            $searchLog->save();
            $query = Product::find()->where('name like "%' . $keyword . '%"')
                ->andFilterWhere(['available' => 'yes'])
                ->andFilterWhere(['or', ['type_product' => Product::PRODUCT_TYPE_SELLER], ['type_product' => Product::PRODUCT_TYPE_ALL]]);
            if (empty($query)) {
                Yii::$app->session->setFlash('error', Yii::t('app', "Нет резултат "));
                return $this->redirect(Yii::$app->homeUrl);
            }
        } else {
            $query = Product::find()->where(['available' => 'yes'])->andFilterWhere(['or', ['type_product' => Product::PRODUCT_TYPE_SELLER], ['type_product' => Product::PRODUCT_TYPE_ALL]]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['created_at' => SORT_DESC]],
        ]);
        return $this->render('search', [
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionSlug($slug)
    {

        if (!Product::find()->where(['slug' => $slug])->exists()) {
            Yii::$app->session->setFlash('error', Yii::t('app', "Таких товаров не существует"));
            return $this->redirect(['product/']);

        }

        $model = Product::find()->where(['slug' => $slug])->one();
        if($model->type_product==Product::PRODUCT_TYPE_DILLER){
            Yii::$app->session->setFlash('error', Yii::t('app', "Этот товар нет в продажа толка доступен диллерская"));
            return $this->redirect(['product/']);
        }
        $otziv = new Productreviews();

        if ($otziv->load(Yii::$app->request->post())) {
            $otziv->status = 0;
            $otziv->user_id = Yii::$app->user->identity->id;
            $otziv->product_id = $model->id;


            if ($otziv->validate() && $otziv->save()) {
                Yii::$app->session->setFlash('success', Yii::t('app', "Спасибо за ваш отзыв."));
                return $this->redirect(['product/' . $slug]);
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app', "Ваш отзыв не удалос
"));
                return $this->redirect(['product/' . $slug]);
            }

        }

        $dataReviewsProvider = new ActiveDataProvider([
            'query' => $model->getReviews(),
        ]);
        $schot = Product::findOne($model->id);
        $schot->updateCounters(['view_count' => 1]);
        //$schot->save();
        return $this->render('view', [
            'model' => $model,
            'otziv' => $otziv,
            'dataReviewsProvider' => $dataReviewsProvider,
        ]);

    }


    public function actionQuikview()
    {
        $id = Yii::$app->request->get('product_id');
        $model = Product::findOne($id);
        if (empty($model)) {
            return false;
        }
        $this->layout = false;
        return $this->render('quikview', compact('model'));
    }


}
