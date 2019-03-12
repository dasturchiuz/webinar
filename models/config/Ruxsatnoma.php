<?php
namespace app\models\config;

use Yii;


class Ruxsatnoma{
    protected $profile;

    public function __construct($prof)
    {
        $this->profile=$prof;
    }

    public static function SuperAdmin($prof){
        if(Yii::$app->user->can('super_admin'))
        {
            return true;
        }else{
            return false;
        }
    }

    public static function Admin($prof){
        if(Yii::$app->user->can('super_admin'))
        {
            return true;
        }
        if(Yii::$app->user->can('admin') && Yii::$app->user->can('IsRegion', ['profile'=>$prof])){
            return true;
        }
        if(Yii::$app->user->can('manager') && Yii::$app->user->can('IsRegion', ['profile'=>$prof])){
            return true;
        }
        if(Yii::$app->user->can('regional_managers') && Yii::$app->user->can('IsRegion', ['profile'=>$prof])){
            return true;
        }
        return false;
    }


    //bu statik funksiya agent va kurierni ko'rishga && tahrirlashga ruxsat berish
        public static function isHuquqRahbariyat(){
            if(Yii::$app->user->can('regional_managers') || Yii::$app->user->can('manager') || Yii::$app->user->can('admin')){
                return true;
            }else{
                return false;
            }
        }
    public static function isHuquqSuperAndAdmin(){
        if(Yii::$app->user->can('super_admin') || Yii::$app->user->can('admin')){
            return true;
        }else{
            return false;
        }
    }

        //bu statik funksiya agent va kurierni ko'rishga && tahrirlashga ruxsat berish
        public static function isHuquqObshe(){
            if(
                Yii::$app->user->can('regional_managers') ||
                Yii::$app->user->can('manager') ||
                Yii::$app->user->can('regional_managers') ||
                Yii::$app->user->can('buxgalter') ||
                Yii::$app->user->can('admin')){
                return true;
            }else{
                return false;
            }
        }
        //bu statik funksiya agent va kurierni ko'rishga && tahrirlashga ruxsat berish
        public static function isHuquqRegion(){
            if(
                Yii::$app->user->can('regional_managers') ||
                Yii::$app->user->can('manager') ||
                Yii::$app->user->can('regional_managers') ||
                Yii::$app->user->can('buxgalter') ||
                Yii::$app->user->can('agent') ||
                Yii::$app->user->can('сouriers') ||
                Yii::$app->user->can('admin')){
                return true;
            }else{
                return false;
            }
        }



    //bu statik funksiya agent va kurierni ko'rishga && tahrirlashga ruxsat berish
    public static function isSuper(){
        if(Yii::$app->user->can('super_admin')){
            return true;
        }else{
            return false;
        }
    }


    public static function isAgentOrCourier($prof){
        if(Yii::$app->user->can('super_admin'))
        {
            return true;
        }
        if(Yii::$app->user->can('admin') && Yii::$app->user->can('IsRegion', ['profile'=>$prof])){
            return true;
        }
        if(Yii::$app->user->can('manager') && Yii::$app->user->can('IsRegion', ['profile'=>$prof])){
            return true;
        }
        if(Yii::$app->user->can('regional_managers') && Yii::$app->user->can('IsRegion', ['profile'=>$prof])){
            return true;
        }
        return false;
    }
}