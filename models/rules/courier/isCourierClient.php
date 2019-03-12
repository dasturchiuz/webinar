<?php
namespace app\models\rules\courier;


use Yii;
use yii\rbac\Rule;

class isCourierClient extends Rule{
    public $name = 'isCourierClient';
    public function execute($user, $item, $params){
        //return true;// isset($params['comment']) ? $params['comment']['created_by'] == Yii::$app->user->getId() : false;
        $data= Yii::$app->db->createCommand("SELECT count(*) FROM orders o LEFT JOIN weeks_client_list w ON w.client_id=o.user_id WHERE o.id='".$params['order']."' and w.user_id='".$user."';")->queryScalar();
        return true; $data > 0 ? true : false;
    }
}