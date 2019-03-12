<?php

namespace app\modules\administration\controllers;

use app\models\User;
use Yii;
use app\models\Profile;
use app\models\ProfileSearch;
use yii\filters\AccessControl;
use yii\db\Query;
use yii\data\ActiveDataProvider;
use app\models\CommentProfile;

class CommentsController extends \yii\web\Controller
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

    public function actionIndex(){
        $searchModel = new \app\models\ProfileCommentSearch();
        if(Yii::$app->user->can('buxgalter') || Yii::$app->user->can('manager') || Yii::$app->user->can('admin') ||Yii::$app->user->can('regional_managers') ){
            $dataProvider = $searchModel->searchAdmin(Yii::$app->user->identity->getRegionId());
        }elseif(Yii::$app->user->can('super_admin')){
            $dataProvider = $searchModel->searchSuperAdmin();
        }else{
            $dataProvider = $searchModel->search(Yii::$app->user->getId());
        }


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


}