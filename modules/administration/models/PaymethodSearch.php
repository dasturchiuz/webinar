<?php

namespace app\modules\administration\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Paymethod;

/**
 * PaymethodSearch represents the model behind the search form of `app\models\Paymethod`.
 */
class PaymethodSearch extends Paymethod
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'payment_status'], 'integer'],
            [['pay_name'], 'safe'],
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
        $query = Paymethod::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'payment_status' => $this->payment_status,
        ]);

        $query->andFilterWhere(['like', 'pay_name', $this->pay_name]);

        return $dataProvider;
    }
}
