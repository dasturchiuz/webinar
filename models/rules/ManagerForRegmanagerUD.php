<?php
namespace app\models\rules;


use Yii;
use yii\rbac\Rule;
class ManagerForRegmanagerUD extends Rule{
    public $name = 'isParentRegmanager';
    public function execute($user, $item, $params){
        return isset($params['manager']) ? $params['manager']->region_id == Yii::$app->user->identity->getRegionId() : false;
    }
}