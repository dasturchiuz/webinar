<?php
namespace app\modules\administration\controllers;

use yii\web\Controller;

class PaymentsController extends Controller{

    public function behaviors()
    {
        return [
            'access'=>[
                'class'=>\yii\filters\AccessControl::className(),
                'rules'=>[
                    [
                        'allow'=>true,
                        'actions'=>['region-payments'],
                        'roles'=>[ 'admin', 'regional_managers', 'manager', 'buxgalter'],
                    ],
                    [
                        'allow'=>true,
                        'actions'=>['all-payments'],
                        'roles'=>[ 'super_admin'],
                    ],

                ],
            ],
        ];
    }
    //super admin uchun
    public function actionAllPayments(){
        $dataProvider=\app\models\checkout\SearchPayments::serachPayAll();

        return $this->render('allpayments', compact('dataProvider'));
    }

    //admin, manager, buxgalter uchun
    public function actionRegionPayments(){
        $dataProvider=\app\models\checkout\SearchPayments::serachPayByRegion(\Yii::$app->user->identity->getRegionId());

        return $this->render('regionpayment', compact('dataProvider'));
    }


    //1. hodimlar tulovini ko'rish

    //2. alohida foydalanuvchini to'lovini ko'rish







}
