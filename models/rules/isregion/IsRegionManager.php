<?php
namespace app\models\rules\isregion;

use Yii;
use yii\rbac\Rule;
class IsRegionManager extends Rule{
    public $name="IsRegionManager";
    public function execute($user, $item, $params){
        return isset($params['manager']) ? $params['manager']->region_id == Yii::$app->user->identity->getRegionId() : false;
    }

}
