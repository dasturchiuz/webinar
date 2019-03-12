<?php

namespace app\modules\administration\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Orders;

/**
 * OrdersSearch represents the model behind the search form of `app\models\Orders`.
 */
class OrdersSearch extends Orders
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'qty', 'user_id', 'region_id', 'pay_status', 'pay_method_id', 'status', 'created_by'], 'integer'],
            [['created_at', 'updated_at', 'firstname', 'lastname', 'adress', 'phone', 'email', 'pay_method_name', 'note'], 'safe'],
            [['sum'], 'number'],
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
    public function search($params)
    {
        $query = Orders::find();





        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>[
                'defaultOrder'=>[
                    'created_at'=>SORT_DESC,
                ]
            ],
        ]);

        $this->load($params);

        if(Yii::$app->user->can('regional_managers'))
        {
            $this->region_id=Yii::$app->user->identity->getRegionId();
        }

        if(Yii::$app->user->can('manager'))
        {
            $this->region_id=Yii::$app->user->identity->getRegionId();
        }

        if(Yii::$app->user->can('agent'))
        {
            $this->created_by=Yii::$app->user->identity->id;
        }

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'qty' => $this->qty,
            'sum' => $this->sum,
            'user_id' => $this->user_id,
            'region_id' => $this->region_id,
            'pay_status' => $this->pay_status,
            'pay_method_id' => $this->pay_method_id,
            'status' => $this->status,

            'created_by' => $this->created_by,
        ]);

        $query->andFilterWhere(['like', 'firstname', $this->firstname])
            ->andFilterWhere(['like', 'lastname', $this->lastname])
            ->andFilterWhere(['like', 'adress', $this->adress])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'pay_method_name', $this->pay_method_name])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
