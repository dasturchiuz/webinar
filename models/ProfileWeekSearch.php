<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Profile;
use app\models\Orders;

/**
 * ProfileSearch represents the model behind the search form of `app\models\Profile`.
 */
class ProfileWeekSearch extends Profile
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
    public function search($user_id, $week)
    {

        $query = Profile::find()
            ->alias('p')
            ->joinWith([
                'weeks' => function($q) use($user_id, $week){
                    $q->alias('w');
                    $q->where(['w.user_id'=>$user_id, 'week_number'=>$week]);


                }
            ])
            ->groupby('p.user_id');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);





        return $dataProvider;
    }
    //agentga biriktirilgan klentlarni olish
    public function search_agent_clients($user_id)
    {

        $query = Profile::find()
            ->alias('p')
            ->joinWith([
                'weeks' => function($q) use($user_id){
                    $q->alias('w');
                    $q->where(['w.user_id'=>$user_id]);
                }
            ])
            
            ->groupby('p.user_id');
        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        return $dataProvider;
    }

    public function searchall($id_curier, $sts)
    {

        $query = Orders::find()
            ->alias('o')
            ->joinWith([
                'profile' => function($q){
                    $q->alias('p');
                },

            ])
            ->joinWith([
                'weeks' => function($q){
                    $q->alias('w');
                }
            ])
            ->select("o.id, o.sum, o.delivery_date as delivery_date, p.*")
            ->where(['w.user_id'=>$id_curier, 'o.delivery_status'=>$sts])
             //oxirgi zakazni order_date deb olib uni profileda order_date o'zgaruvchisiga set qildim
            ;

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['created_at' => SORT_DESC]],
            'pagination' => [
                'pageSize' => 10,
            ],
            //'sort'=>['defaultOrder'=>['created_by'=>SORT_DESC]]
        ]);
        return $dataProvider;
    }

    public function searchallByRegion($region_id, $sts)
    {

        $query = Orders::find()
            ->alias('o')
            ->joinWith([
                'profile' => function($q){
                    $q->alias('p');
                },

            ])
            ->select("o.id, o.sum, o.delivery_date as delivery_date, p.*")
            ->where(['o.delivery_status'=>$sts, 'p.role'=>['client', 'client_juridical'], 'p.region_id'=>$region_id])
            //oxirgi zakazni order_date deb olib uni profileda order_date o'zgaruvchisiga set qildim
        ;

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

    public function searchShart($curier_id, $sts, $date)
    {

        $query = Orders::find()
            ->alias('o')
            ->joinWith([
                'profile' => function($q){
                    $q->alias('p');
                },

            ])
            ->joinWith([
                'weeks' => function($q){
                    $q->alias('w');
                }
            ])
            ->select("o.id, o.sum, o.delivery_date as delivery_date, p.*")
            ->where(['w.user_id'=>$curier_id, 'o.delivery_status'=>$sts, 'o.delivery_date' => $date])
             //oxirgi zakazni order_date deb olib uni profileda order_date o'zgaruvchisiga set qildim
            ;

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

    public function searchShartAdmin($region_id, $sts, $date)
    {

        $query = Orders::find()
            ->alias('o')
            ->joinWith([
                'profile' => function($q){
                    $q->alias('p');
                },
            ])
            ->select("o.id, o.sum, o.delivery_date as delivery_date, p.*")
            ->where([ 'o.delivery_status'=>$sts, 'o.delivery_date' => $date, 'p.role'=>['client', 'client_juridical'], 'p.region_id'=>$region_id])
             //oxirgi zakazni order_date deb olib uni profileda order_date o'zgaruvchisiga set qildim
            ;

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

    public function searchShartToday($curier_id, $sts, $date)
    {

        $query = Orders::find()
            ->alias('o')
            ->joinWith([
                'profile' => function($q){
                    $q->alias('p');
                },

            ])
            ->joinWith([
                'weeks' => function($q){
                    $q->alias('w');
                }
            ])
            ->select("o.id, o.sum, o.delivery_date as delivery_date, p.*")
            ->where(['w.user_id'=>$curier_id, 'o.delivery_status'=>$sts, 'DATE(o.delivered_date)' => $date])
             //oxirgi zakazni order_date deb olib uni profileda order_date o'zgaruvchisiga set qildim
            ;

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

    public function searchShartTodayAdm($region_id, $sts, $date)
    {

        $query = Orders::find()
            ->alias('o')
            ->joinWith([
                'profile' => function($q){
                    $q->alias('p');
                },
            ])
            ->select("o.id, o.sum, o.delivery_date as delivery_date, p.*")
            ->where(['o.delivery_status'=>$sts, 'DATE(o.delivered_date)' => $date, 'p.role'=>['client', 'client_juridical'], 'p.region_id'=>$region_id])
             //oxirgi zakazni order_date deb olib uni profileda order_date o'zgaruvchisiga set qildim
            ;
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
    public function searchAdminToday($region_id, $sts, $date)
    {

        $query = Orders::find()
            ->alias('o')
            ->joinWith([
                'profile' => function($q){
                    $q->alias('p');
                },

            ])
            ->select("o.id, o.sum, o.delivery_date as delivery_date, p.*")
            ->where([ 'o.delivery_status'=>$sts, 'o.delivery_date' => $date, 'p.role'=>['client', 'client_juridical'], 'p.region_id'=>$region_id])
             //oxirgi zakazni order_date deb olib uni profileda order_date o'zgaruvchisiga set qildim
            ;

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

//    public function searchall()
//    {
//
//        $query = Profile::find()
//            ->alias('p')
//            ->joinWith([
//                'orders' => function($q) use($created_id, $status_id){
//                    $q->alias('o');
//                    $q->select('MAX(FROM_UNIXTIME(o.created_at)) as order_date');
//                    $q->where(['o.created_by'=>$created_id, 'o.status'=>$status_id]);
//                    $q->groupby('o.user_id');
//                    $q->orderBy(['MAX(FROM_UNIXTIME(o.created_at))'=>SORT_DESC]);
//                }
//            ])->select("p.*, MAX(FROM_UNIXTIME(o.created_at)) as order_date") //oxirgi zakazni order_date deb olib uni profileda order_date o'zgaruvchisiga set qildim
//            ->where(['role'=>$tip_client]);
//
//        // add conditions that should always apply here
//
//        $dataProvider = new ActiveDataProvider([
//            'query' => $query,
//            'pagination' => [
//                'pageSize' => 10,
//            ],
//            //'sort'=>['defaultOrder'=>['created_by'=>SORT_DESC]]
//        ]);
//
//
//
//
//
//        return $dataProvider;
//
//
//
//
//
//        return $dataProvider;
//    }
}
