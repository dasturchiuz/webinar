<?php
namespace app\components\bootstrapunset;

use yii\base\Component;
class UnsetBootstrapFromMultiSelect extends  Component
{
    public function Bootstrapremove(){
        $unsets=new \app\components\bootstrapunset\Bootunset();
        $unsets->run();


    }

}

