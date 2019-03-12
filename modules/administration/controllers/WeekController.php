<?php

namespace app\modules\administration\controllers;
use app\models\User;
use Yii;
use app\models\Profile;
use app\models\ProfileWeekSearch;
use yii\filters\AccessControl;
use yii\db\Query;
use yii\data\ActiveDataProvider;
use app\models\CommentProfile;
class WeekController extends \yii\web\Controller
{
    public function behaviors(){
        return [
            'access'=>[
                'class'=>AccessControl::className(),
                'rules'=>[
                    [
                        'allow'=>true,
                        'roles'=>['super_admin', 'admin', 'regional_managers', 'manager', 'buxgalter', 'agent', 'сouriers'],
                    ],

                ],
            ],
        ];
    }

    public function actionBy($week_num)
    {
        $searchModel = new ProfileWeekSearch();
        $dataProvider = $searchModel->search(Yii::$app->user->getId(), $week_num);

        return $this->render('by', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'week_num'=>$week_num
        ]);
    }


}
