<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Profile;

/**
 * ProfileSearch represents the model behind the search form of `app\models\Profile`.
 */
class ProfileCommentSearch extends Profile
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
    public function search($user_id)
    {

        $query = Profile::find()
            ->alias('p')
            ->joinWith([
                'coment' => function($q){
                    $q->alias('c');
                }]
            )->leftJoin('weeks_client_list w', 'w.client_id=c.profile_id')
            ->where(['w.user_id'=>$user_id])
            ;

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        return $dataProvider;
    }

    public function searchAdmin($region_id)
    {

        $query = Profile::find()
            ->alias('p')
            ->innerJoinWith(
                [
                    'coment' => function($q){
                        $q->alias('c');
                    },
                ]
            )->where(['region_id'=>$region_id,])
        ->groupby('p.user_id');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        return $dataProvider;
    }
public function searchSuperAdmin()
    {

        $query = Profile::find()
            ->alias('p')
            ->innerJoinWith(
                [
                    'coment' => function($q){
                        $q->alias('c');
                    },
                ]
            );

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        return $dataProvider;
    }

}
