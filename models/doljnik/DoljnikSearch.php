<?php

namespace app\models\doljnik;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Profile;
use app\models\Orders;

/**
 * ProfileSearch represents the model behind the search form of `app\models\Profile`.
 */
class DoljnikSearch extends Profile
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

    //kurierni klentlari buyicha dfoljniklareni chaqirish
    public function search($id_curier)
    {
        $query = \app\models\Debitor::find()
            ->alias('d')
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
            ->joinWith([
                'orders' => function($q){
                    $q->alias('o');
                },

            ])
            ->where(['w.user_id'=>$id_curier])
            ->groupby('d.id')
            //oxirgi zakazni order_date deb olib uni profileda order_date o'zgaruvchisiga set qildim
        ;
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            //'sort'=>['defaultOrder'=>['created_by'=>SORT_DESC]]
        ]);
        return $dataProvider;
    }
    //admin buyicha chaqirish
    public function searchRahbariyat($region_id)
    {
        $query = \app\models\Debitor::find()
            ->alias('d')
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
            ->joinWith([
                'orders' => function($q){
                    $q->alias('o');
                },

            ])
            ->where(['p.region_id'=>$region_id,])
            ->groupby('d.id')
            //oxirgi zakazni order_date deb olib uni profileda order_date o'zgaruvchisiga set qildim
        ;
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            //'sort'=>['defaultOrder'=>['created_by'=>SORT_DESC]]
        ]);
        return $dataProvider;
    }

    //super admin
    public function searchDoljnikSuper()
    {
        $query = \app\models\Debitor::find()
            ->alias('d')
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
            ->joinWith([
                'orders' => function($q){
                    $q->alias('o');
                },

            ])
            ->groupby('d.id')
            //oxirgi zakazni order_date deb olib uni profileda order_date o'zgaruvchisiga set qildim
        ;
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,

            //'sort'=>['defaultOrder'=>['created_by'=>SORT_DESC]]
        ]);
        return $dataProvider;
    }
}
