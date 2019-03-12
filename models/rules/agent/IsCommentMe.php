<?php
namespace app\models\rules\agent;


use Yii;
use yii\rbac\Rule;

class IsCommentMe extends Rule{
    public $name = 'isCommentMe';
    public function execute($user, $item, $params){
        return false;// isset($params['comment']) ? $params['comment']['created_by'] == Yii::$app->user->getId() : false;
    }
}