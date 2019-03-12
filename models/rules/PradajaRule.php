<?php
namespace app\models\rules;
use Yii;
use yii\rbac\Rule;
use app\models\Profile;

//region id buyicha tekshirsh
class PradajaRule extends Rule
{
    public $name = "isRulePradaja";

    public function execute($user, $item, $params){
        return isset($params['order']) ? $params['order']->region_id == Yii::$app->user->identity->getRegionId() : false;
    }
}