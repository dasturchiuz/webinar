<?php
namespace app\models\rules;


use Yii;
use yii\rbac\Rule;
class ProfileParentUser extends Rule{
    public $name = 'isParentProfile';
    public function execute($user, $item, $params){
        return isset($params['profile']) ? $params['profile']->created_by == $user : false;
    }
}