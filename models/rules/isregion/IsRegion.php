<?php
namespace app\models\rules\isregion;

use Yii;
use yii\rbac\Rule;
class IsRegion extends Rule{
    public $name="IsRegion";
    public function execute($user, $item, $params){
        return isset($params['profile']) ? $params['profile']->region_id == Yii::$app->user->identity->getRegionId() : false;

    }
}
