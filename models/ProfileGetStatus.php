<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Profile;

/**
 * ProfileSearch represents the model behind the search form of `app\models\Profile`.
 */
class ProfileGetStatus extends Profile
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
    public function search($user_id, $sts)
    {

        $query = Profile::find()
            ->alias('p')
            ->joinWith([
                    'user' => function($q){
                        $q->alias('u');

                    }]
            )->leftJoin('weeks_client_list w', 'w.client_id=p.user_id')
            ->where(['w.user_id'=>$user_id, 'u.status'=>$sts])
        ;

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);





        return $dataProvider;
    }
    //rahbariyat uchun
    public function searchRahbariyat($sts, $reg_id)
    {

        $query = Profile::find()
            ->alias('p')
            ->joinWith([
                    'user' => function($q){
                        $q->alias('u');

                    }]
            )
            ->where(['region_id'=>$reg_id, 'u.status'=>$sts]);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        return $dataProvider;
    }

    //super admin uchun
    public function searchSuperAdmin($sts)
    {

        $query = Profile::find()
            ->alias('p')
            ->joinWith([
                    'user' => function($q){
                        $q->alias('u');

                    }]
            )
            ->where([ 'u.status'=>$sts]);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        return $dataProvider;
    }
}
