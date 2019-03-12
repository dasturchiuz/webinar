<?php
namespace app\models\checkout;

use Yii;
use app\models\Debitor;
use app\models\User;
use app\models\CommentProfile;
use app\models\Invoices;
use app\models\Orders;
use yii\data\ActiveDataProvider;

class SearchPayments
{



    public static function serachPayByRegion($region_id){
        $query=Invoices::find()
            ->alias("i")
            ->joinWith(
                [
                    'order'=>function($q){
                        $q->alias("o");
                    }
                ]
            )
            ->where(['o.region_id'=>$region_id]);

        $dataProvider=new ActiveDataProvider([
            'query'=>$query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        return $dataProvider;
    }

    public static function serachPayByRegionProfile($region_id, $profile_id){
        $query=Invoices::find()
            ->alias("i")
            ->joinWith(
                [
                    'order'=>function($q){
                        $q->alias("o");
                    }
                ]
            )
            ->where(['o.region_id'=>$region_id, 'o.user_id'=>$profile_id]);

        $dataProvider=new ActiveDataProvider([
            'query'=>$query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        return $dataProvider;
    }

    public static function serachPayAll(){
        $query=Invoices::find()
            ->alias("i")
            ->joinWith(
                [
                    'order'=>function($q){
                        $q->alias("o");
                    }
                ]
            );

        $dataProvider=new ActiveDataProvider([
            'query'=>$query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        return $dataProvider;
    }
}