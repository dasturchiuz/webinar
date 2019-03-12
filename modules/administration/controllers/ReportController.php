<?php

namespace app\modules\administration\controllers;
use Yii;
use app\models\Profile;
use yii\data\ActiveDataProvider;
use app\models\CommentProfile;
use app\models\User;
use yii\helpers\Url;
use yii\filters\AccessControl;
class ReportController extends \yii\web\Controller
{
    public function behaviors(){
        return [
            'access'=>[
                'class'=>AccessControl::className(),
                'rules'=>[
                    [
                        'allow'=>true,
                        'roles'=>['super_admin', 'admin', 'regional_managers', 'buxgalter', 'agent', 'manager'],
                    ],
                    [
                        'allow'=>true,
                        'actions'=>['clientjuridicalbyid', 'clientbyid'],
                        'roles'=>['super_admin', 'admin'],
                    ]
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionClientjuridical($statis_date=null)
    {
//        $region_id=Yii::$app->user->identity->getRegionId();
//        var_dump(\app\models\Profile::getJuridicalByAdmin($region_id, 'client_juridical'));
//
//        die();

        $user_id=Yii::$app->user->getId();
        if(Yii::$app->user->can('agent')){
            $statis_order_count=\app\models\Profile::getStatisdiagram($user_id, 'client_juridical', $statis_date!=null ? "'$statis_date'" : null);
            $statis_order_sum=\app\models\Profile::getStatissum($user_id, 'client_juridical', $statis_date!=null ? "'$statis_date'" : null);
            $statis_status_count=\app\models\Profile::getAlllitso($user_id, 'client_juridical');
            $statis_zakazchik_count=\app\models\Profile::getZakazchik($user_id, 'client_juridical', $statis_date!=null ? "'$statis_date'" : null);

            return $this->render('index', compact('statis_order_count', 'statis_status_count', 'statis_zakazchik_count', 'statis_order_sum'));
        }

        if(\app\models\config\Ruxsatnoma::isHuquqObshe()){

            $statis_order_count=\app\models\Profile::getStatisdiagramByAdmin($user_id, 'client_juridical', $statis_date!=null ? "'$statis_date'" : null);
            $statis_order_sum=\app\models\Profile::getStatissumAdmin($user_id, 'client_juridical', $statis_date!=null ? "'$statis_date'" : null);
            $statis_status_count=\app\models\Profile::getAlllitsoByAdmin($user_id, 'client_juridical');
            $statis_zakazchik_count=\app\models\Profile::getZakazchikAdmin(Yii::$app->user->identity->getRegionId(), 'client_juridical', $statis_date!=null ? "'$statis_date'" : null);

            return $this->render('index', compact('statis_order_count', 'statis_status_count', 'statis_zakazchik_count', 'statis_order_sum'));
        }
        if(\app\models\config\Ruxsatnoma::isSuper()){

            $statis_order_count=\app\models\Profile::getStatisdiagramBySuperAdmin('client_juridical', $statis_date!=null ? "'$statis_date'" : null);
            $statis_order_sum=\app\models\Profile::getStatissumSuperAdmin( 'client_juridical', $statis_date!=null ? "'$statis_date'" : null);
            $statis_status_count=\app\models\Profile::getAlllitsoBySuperAdmin('client_juridical');
            $statis_zakazchik_count=\app\models\Profile::getZakazchikSuperAdmin( 'client_juridical', $statis_date!=null ? "'$statis_date'" : null);

            return $this->render('index', compact('statis_order_count', 'statis_status_count', 'statis_zakazchik_count', 'statis_order_sum'));
        }

    }
    public function actionClient($statis_date=null)
    {

        $user_id=Yii::$app->user->getId();
        if(Yii::$app->user->can('agent')){
            $statis_order_count=\app\models\Profile::getStatisdiagram($user_id, 'client', $statis_date!=null ? "'$statis_date'" : null);
            $statis_order_sum=\app\models\Profile::getStatissum($user_id, 'client', $statis_date!=null ? "'$statis_date'" : null);
            $statis_status_count=\app\models\Profile::getAlllitso($user_id, 'client');
            $statis_zakazchik_count=\app\models\Profile::getZakazchik($user_id, 'client', $statis_date!=null ? "'$statis_date'" : null);

            return $this->render('client', compact('statis_order_count', 'statis_status_count', 'statis_zakazchik_count', 'statis_order_sum'));
        }



        if(\app\models\config\Ruxsatnoma::isHuquqObshe()){

            $statis_order_count=\app\models\Profile::getStatisdiagramByAdmin($user_id, 'client', $statis_date!=null ? "'$statis_date'" : null);
            $statis_order_sum=\app\models\Profile::getStatissumAdmin($user_id, 'client', $statis_date!=null ? "'$statis_date'" : null);
            $statis_status_count=\app\models\Profile::getAlllitsoByAdmin($user_id, 'client');
            $statis_zakazchik_count=\app\models\Profile::getZakazchikAdmin(Yii::$app->user->identity->getRegionId(), 'client', $statis_date!=null ? "'$statis_date'" : null);

            return $this->render('client', compact('statis_order_count', 'statis_status_count', 'statis_zakazchik_count', 'statis_order_sum'));
        }

        if(\app\models\config\Ruxsatnoma::isSuper()){

            $statis_order_count=\app\models\Profile::getStatisdiagramBySuperAdmin('client', $statis_date!=null ? "'$statis_date'" : null);
            $statis_order_sum=\app\models\Profile::getStatissumSuperAdmin( 'client', $statis_date!=null ? "'$statis_date'" : null);
            $statis_status_count=\app\models\Profile::getAlllitsoBySuperAdmin('client');
            $statis_zakazchik_count=\app\models\Profile::getZakazchikSuperAdmin( 'client', $statis_date!=null ? "'$statis_date'" : null);
            return $this->render('client', compact('statis_order_count', 'statis_status_count', 'statis_zakazchik_count', 'statis_order_sum'));
        }
    }

    public function actionClientjuridicalbyid($user_id, $statis_date=null)
    {
        $model=\app\models\Profile::findOne($user_id);
        $statis_order_count=\app\models\Profile::getStatisdiagram($user_id, 'client_juridical', $statis_date!=null ? "'$statis_date'" : null);
        $statis_order_sum=\app\models\Profile::getStatissum($user_id, 'client_juridical', $statis_date!=null ? "'$statis_date'" : null);
        $statis_status_count=\app\models\Profile::getAlllitso($user_id, 'client_juridical');
        $statis_zakazchik_count=\app\models\Profile::getZakazchik($user_id, 'client_juridical', $statis_date!=null ? "'$statis_date'" : null);
        return $this->render('juridicalbyid', compact('statis_order_count', 'statis_status_count', 'statis_zakazchik_count', 'statis_order_sum', 'user_id', 'model'));
    }





    public function actionClientbyid($user_id, $statis_date=null)
    {
        $model=\app\models\Profile::findOne($user_id);
            $statis_order_count=\app\models\Profile::getStatisdiagram($user_id, 'client', $statis_date!=null ? "'$statis_date'" : null);
            $statis_order_sum=\app\models\Profile::getStatissum($user_id, 'client', $statis_date!=null ? "'$statis_date'" : null);
            $statis_status_count=\app\models\Profile::getAlllitso($user_id, 'client');
            $statis_zakazchik_count=\app\models\Profile::getZakazchik($user_id, 'client', $statis_date!=null ? "'$statis_date'" : null);
            return $this->render('clbyid', compact('statis_order_count', 'statis_status_count', 'statis_zakazchik_count', 'statis_order_sum', 'user_id', 'model'));
    }



}
