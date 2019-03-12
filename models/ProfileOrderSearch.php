<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Profile;

/**
 * ProfileSearch represents the model behind the search form of `app\models\Profile`.
 */
class ProfileOrderSearch extends Profile
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'is_juridical', 'status', 'created_at', 'updated_at', 'region_id'], 'integer'],
            [['firstname', 'lastname', 'fathername', 'tell', 'role', 'adress'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    //prinytat bulgan zakazlarni admin, ... larga chiqarish
    public function search($created_id, $tip_client, $status_id)
    {
/*
 * SELECT o.* FROM profile p
 * LEFT JOIN orders o ON p.user_id = o.user_id
 * LEFT JOIN weeks_client_list w ON w.client_id=p.user_id
 * WHERE `role`='client_juridical' and (`o`.`status`=10) AND w.user_id=39
 * */
        $query = Profile::find()
            ->alias('p')
            ->joinWith([
                'orders' => function($q) use($status_id, $tip_client){
                    $q->alias('o');
                    $q->select('MAX(FROM_UNIXTIME(o.created_at)) as order_date');
                    $q->where([ 'o.status'=>$status_id]);
                    $q->groupby('o.user_id');
                    $q->orderBy(['MAX(FROM_UNIXTIME(o.created_at))'=>SORT_DESC]);
                }
            ])
            ->joinWith([
                'weeks' => function($q) use($created_id, $status_id){
                    $q->alias('w');
                    $q->where([ 'w.user_id'=>$created_id]);
                }
            ])
            ->select("p.*, MAX(FROM_UNIXTIME(o.created_at)) as order_date") //oxirgi zakazni order_date deb olib uni profileda order_date o'zgaruvchisiga set qildim
            ->where(['role'=>$tip_client]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            //'sort'=>['defaultOrder'=>['created_by'=>SORT_DESC]]
        ]);
        return $dataProvider;
    }

    //Keyingi versiyada prinyati zakazlar ni umumiy chiqarish!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!**********************

    //prinytat bulgan zakazlarni admin, ... larga chiqarish
    public function searchOrder($created_id, $tip_client, $status_id)
    {
/*
 * SELECT o.* FROM profile p
 * LEFT JOIN orders o ON p.user_id = o.user_id
 * LEFT JOIN weeks_client_list w ON w.client_id=p.user_id
 * WHERE `role`='client_juridical' and (`o`.`status`=10) AND w.user_id=39
 * */
//        $query = \app\models\Orders::find()
//        ->alias('o')
//        joinWith;

        $query = Profile::find()
            ->alias('p')
            ->joinWith([
                'orders' => function($q) use($status_id, $tip_client){
                    $q->alias('o');
                    $q->select('MAX(FROM_UNIXTIME(o.created_at)) as order_date');
                    $q->where([ 'o.status'=>$status_id]);
                    $q->groupby('o.user_id');
                    $q->orderBy(['MAX(FROM_UNIXTIME(o.created_at))'=>SORT_DESC]);
                }
            ])
            ->joinWith([
                'weeks' => function($q) use($created_id, $status_id){
                    $q->alias('w');
                    $q->where([ 'w.user_id'=>$created_id]);
                }
            ])
            ->select("p.*, MAX(FROM_UNIXTIME(o.created_at)) as order_date") //oxirgi zakazni order_date deb olib uni profileda order_date o'zgaruvchisiga set qildim
            ->where(['role'=>$tip_client]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            //'sort'=>['defaultOrder'=>['created_by'=>SORT_DESC]]
        ]);
        return $dataProvider;
    }

    //Prinyat bo'lgan zakazlarni8 super adminga chiqarish
    public function searchSuperAdmin($tip_client, $status_id)
    {

        $query = Profile::find()
            ->alias('p')
            ->joinWith([
                'orders' => function($q) use($status_id){
                    $q->alias('o');
                    $q->select('MAX(FROM_UNIXTIME(o.created_at)) as order_date');
                    $q->where([ 'o.status'=>$status_id]);
                    $q->groupby('o.user_id');
                    $q->orderBy(['MAX(FROM_UNIXTIME(o.created_at))'=>SORT_DESC]);
                }
            ])->select("p.*, MAX(FROM_UNIXTIME(o.created_at)) as order_date") //oxirgi zakazni order_date deb olib uni profileda order_date o'zgaruvchisiga set qildim
            ->where(['role'=>$tip_client]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            //'sort'=>['defaultOrder'=>['created_by'=>SORT_DESC]]
        ]);
        return $dataProvider;
    }

    //Prinyat bo'lgan zakazlarni8 super adminga chiqarish
    public function searchRahbariyat($tip_client, $region_id,  $status_id)
    {

        $query = Profile::find()
            ->alias('p')
            ->joinWith([
                'orders' => function($q) use($status_id, $region_id){
                    $q->alias('o');
                    $q->select('MAX(FROM_UNIXTIME(o.created_at)) as order_date');
                    $q->where([ 'o.status'=>$status_id, 'o.region_id'=>$region_id]);
                    $q->groupby('o.user_id');
                    $q->orderBy(['MAX(FROM_UNIXTIME(o.created_at))'=>SORT_DESC]);
                }
            ])->select("p.*, MAX(FROM_UNIXTIME(o.created_at)) as order_date") //oxirgi zakazni order_date deb olib uni profileda order_date o'zgaruvchisiga set qildim
            ->where(['role'=>$tip_client]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            //'sort'=>['defaultOrder'=>['created_by'=>SORT_DESC]]
        ]);
        return $dataProvider;
    }
}
