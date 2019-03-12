<?php

namespace app\modules\administration\controllers;
use Yii;
use app\models\Profile;
use app\models\ProductSearch;
use app\models\Product;
use app\models\Cart;
use yii\filters\AccessControl;

use yii\data\ActiveDataProvider;
use app\models\CommentProfile;
use app\models\User;
use yii\helpers\Url;
use yii\filters\VerbFilter;
class HistoryOrderController extends \yii\web\Controller
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
    public function actionIndex()
    {

    }

    public function actionMe($client){
        $searchModel = new \app\models\ProfileOrderSearch();

        if(Yii::$app->user->can('super_admin')){
            $dataProvider = $searchModel->searchSuperAdmin($client, \app\models\Orders::STATUS_NEW);
        }elseif(\app\models\config\Ruxsatnoma::isHuquqRahbariyat()){
            $dataProvider = $searchModel->searchRahbariyat( $client,Yii::$app->user->identity->getRegionId(), \app\models\Orders::STATUS_NEW);
        }else{
            $dataProvider = $searchModel->search(Yii::$app->user->getId(), $client, \app\models\Orders::STATUS_NEW);
        }

//        var_dump($dataProvider);
//        die();
        return $this->render('historyme', compact('dataProvider', 'client'));
    }

    public function actionPurchaseHistory($profile_id){

        return $this->render('purchase');
    }

    public function actionCreditHistory($profile_id){

        return $this->render('credit');
    }
    public function actionPrepaymentHistory($profile_id){
        $model=\app\models\Profile::findOne($profile_id);
        if(!Yii::$app->user->can('super_admin')){
            if(!Yii::$app->user->can('IsRegion', ['profile'=>$model]) ){
                Yii::$app->session->setFlash('error', "Этом клент не ваш регион");

                return $this->redirect(['/administration/'.$model->role=="client_juridical" ? "clientjuridical" : "client".'/client-info', 'id'=>$model->user_id]);
            }
        }

        $dataProvider=\app\models\checkout\SearchPayments::serachPayByRegionProfile(\Yii::$app->user->identity->getRegionId(), $profile_id);

        return $this->render('prepayment', compact('dataProvider'));
    }

    public function actionDebtHistory($profile_id){
        $model=\app\models\Profile::findOne($profile_id);
        if(!Yii::$app->user->can('super_admin')){
            if(!Yii::$app->user->can('IsRegion', ['profile'=>$model])){
                Yii::$app->session->setFlash('error', "Этом клент не ваш регион");

                return $this->redirect(['/administration/'.$model->role=="client_juridical" ? "clientjuridical" : "client".'/client-info', 'id'=>$model->user_id]);
            }
        }
        $dataProvider=new ActiveDataProvider([
            'query'=>\app\models\Debitor::find()->where([ 'profile_id'=>$profile_id]),
            'sort'=>[
                'defaultOrder'=>[
                    'created_at'=>SORT_DESC,
                ]
            ],
        ]);
        return $this->render('debt', compact('dataProvider'));
    }

    public function actionClient($profile_id){
        $model=Profile::findOne($profile_id);
        $dataProvider=new ActiveDataProvider([
            'query'=>\app\models\Orders::find()->where(['user_id'=>$profile_id]),
            'sort'=> ['defaultOrder' => ['created_at'=>SORT_DESC]]
        ]);


        return $this->render('historyview', compact('dataProvider', 'model'));

    }

    public function actionOrderView($profile_id, $order_id){
        $modelmagazin=Profile::findOne($profile_id);
        $model=\app\models\Orders::find()->where(['user_id'=>$profile_id, 'id'=>$order_id])->one();
        if($model==null)
        {
            Yii::$app->session->setFlash('error', 'Заказ не найдено');
            return $this->redirect(['history-order', 'profile_id'=>$profile_id]);
        }

        return $this->render('orderview', compact( 'model', 'modelmagazin'));
    }

    public function actionEditOrder($profile_id, $order_id){

        $modelmagazin=Profile::findOne($profile_id);
        $model=\app\models\Orders::find()->where(['user_id'=>$profile_id, 'id'=>$order_id])->one();
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);



        if($model==null)
        {
            Yii::$app->session->setFlash('error', 'Заказ не найдено');
            return $this->redirect(['history-order', 'profile_id'=>$profile_id]);
        }
        $modelOrder = new \yii\base\DynamicModel(['item_product_qty']);
        $modelOrder->addRule(['item_product_qty'], 'safe');
        if($modelOrder->load(Yii::$app->request->post()) && Yii::$app->request->isAjax){
            foreach($modelOrder->item_product_qty as $id=>$qty){
                $cart=new \app\models\Cart();
                $cart->addqtytoorder($id, $qty);
            }
            Yii::$app->session->setFlash('success', 'Успешно обновлено');
           // return $this->redirect(Yii::$app->request->referrer);

        }

        return $this->render('orderedit', compact( 'model', 'modelmagazin', 'modelOrder', 'searchModel','dataProvider' ));
    }

    public function actionAddToOrder($product_id, $order_id){
        $product=Product::findOne($product_id);
        if(empty($product)){
            Yii::$app->session->setFlash('error', 'Тавар не сушшуствуйт');
            return $this->redirect(Yii::$app->request->referrer);
        }
        $cart=new Cart();
        if($cart->addToOrder($product, $order_id)){
            Yii::$app->session->setFlash('success', 'Успешно дабовлено тавар:  '.$product->name);
            return $this->redirect(Yii::$app->request->referrer);
        }else{
            Yii::$app->session->setFlash('error', 'Ошибка'.$product->name);
            return $this->redirect(Yii::$app->request->referrer);
        }

    }

    public function actionDeleteItem($id){
        $cart=new \app\models\Cart();
        if($cart->deleteitem($id)){
            Yii::error('ssss');
            Yii::$app->session->setFlash('success', 'Успешно удалено');

        }else{
            Yii::$app->session->setFlash('error', 'Ошибка');

        }
        Yii::error('dsadsadsa');
        return $this->redirect(Yii::$app->request->referrer);
    }
}
