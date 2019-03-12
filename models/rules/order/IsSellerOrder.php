<?php
namespace app\models\rules\order;
use Yii;
use yii\rbac\Rule;

class IsSellerOrder extends Rule
{
    public $name = 'IsSellerOrder';

    public function execute($user, $item, $params){
//        var_dump(\app\models\Orders::find()->where(['id'=>$params['order_id'], 'seller_id'=>Yii::$app->user->identity->id])->exists());
//        die();
        return \app\models\Orders::find()->where(['id'=>$params['order_id'], 'seller_id'=>Yii::$app->user->identity->id])->exists();

    }
}