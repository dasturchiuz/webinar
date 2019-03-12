<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;


class MainController extends \yii\web\Controller
{
    public function actionIndex()
    {
        echo \app\models\config\UserActions::isBlack();
        $products=\app\models\Product::find()->limit(12)->all();
        return $this->render('index', [
            'productmodel'=>$products,
        ]);
    }

}
