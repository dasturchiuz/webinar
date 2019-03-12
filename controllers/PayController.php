<?php
namespace app\controllers;

use Yii;
//use yii\rest\ActiveController;
use yii\rest\ActiveController;
use app\models\payme\Payme;


class PayController extends ActiveController{


    public $modelClass = 'app\models\Profile';

//    public function behaviors()
//    {
//        $behaviors = parent::behaviors();
//        // add CORS filter
//        $behaviors['corsFilter'] = [
//            'class' => \yii\filters\Cors::className(),
//        ];
//        return $behaviors;
//    }

    public function actions(){
        $actions = parent::actions();
        unset($actions['create']);
        unset($actions['update']);
        unset($actions['delete']);
        unset($actions['view']);
        unset($actions['index']);
        return $actions;
    }


    public function actionTest()
    {

        $request_body  = file_get_contents('php://input');
        
        if($request_body){
            $res=(new Payme($request_body))->response();
            return $res;
        }
    }

}
