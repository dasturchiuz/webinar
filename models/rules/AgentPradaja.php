<?php
namespace app\models\rules;
use Yii;
use yii\rbac\Rule;
use app\models\Profile;

//region id buyicha tekshirsh
class AgentPradaja extends Rule
{
    public $name = "isAgentPradaja";

    public function execute($user, $item, $params){
        return isset($params['order']) ? $params['order']->created_by == Yii::$app->user->identity->id : false;
    }
}