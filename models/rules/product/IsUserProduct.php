<?php
/**
 * Created by PhpStorm.
 * User: loock
 * Date: 2/20/19
 * Time: 11:07 PM
 */
namespace app\models\rules\product;

use Yii;
use yii\rbac\Rule;

class IsUserProduct extends Rule
{
    public $name = 'IsUserProduct';

    public function execute($user, $item, $params){

        return \app\models\Product::find()->where(['id'=>$params['product_id'], 'user_id'=>Yii::$app->user->identity->id])->exists();

    }
}