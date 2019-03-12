<?php
/**
 * Created by PhpStorm.
 * User: loock
 * Date: 3/4/19
 * Time: 1:04 PM
 */

namespace app\controllers;


use app\models\Profile;

class DealerController extends \yii\web\Controller
{


    public function actionIndex()
    {
        $model=new \app\models\dealer\Dealer();
        $dataProvider=$model->searchDealer();

        return $this->render('index', compact('dataProvider'));
    }

    public function actionLogo($magazin_id){
        $model=Profile::findOne($magazin_id);
        if(!empty($model->logo))
            return $model->logo->logo;
        else
            return \Yii::$app->response->sendFile(\Yii::getAlias("@app")."/web/images/default-avatar.png")->send();
    }

}