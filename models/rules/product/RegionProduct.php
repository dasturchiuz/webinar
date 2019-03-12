<?php
namespace app\models\rules\product;


use Yii;
use yii\rbac\Rule;

class RegionProduct extends Rule{
    public $name = 'isRegProduct';
    public function execute($user, $item, $params){
        //return true;// isset($params['comment']) ? $params['comment']['created_by'] == Yii::$app->user->getId() : false;
        //$data= Yii::$app->db->createCommand("SELECT count(*) FROM orders o LEFT JOIN weeks_client_list w ON w.client_id=o.user_id WHERE o.id='".$params['order']."' and w.user_id='".$user."';")->queryScalar();
        return \app\models\Profile::find()->where(['user_id'=>$params['user_id'], 'region_id'=>Yii::$app->user->identity->getRegionId()])->exists();

    }
}