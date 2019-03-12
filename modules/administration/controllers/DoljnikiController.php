<?php

namespace app\modules\administration\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\doljnik\DoljnikSearch;
/**
 * DeliveryMethodController implements the CRUD actions for DeliveryMethod model.
 */
class DoljnikiController extends Controller
{
    public function behaviors(){
        return [
            'access'=>[
                'class'=>AccessControl::className(),
                'rules'=>[
                    [
                        'allow'=>true,
                        'roles'=>['super_admin', 'admin', 'regional_managers', 'manager', 'сouriers'],
                    ],
                ],
            ],
        ];
    }
    public function actionIndex()
    {
        $searchModel = new DoljnikSearch();
        if(\app\models\config\Ruxsatnoma::isHuquqRahbariyat()){
            $dataProvider = $searchModel->searchRahbariyat(Yii::$app->user->identity->getRegionId());

        }elseif(\app\models\config\Ruxsatnoma::isSuper()){
            $dataProvider = $searchModel->searchDoljnikSuper(Yii::$app->user->identity->getRegionId());
        }else{
            $dataProvider = $searchModel->search(Yii::$app->user->getId(), 'сouriers');

        }
        //echo $dataProvider->pagination->pageSize;

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }


}
