<?php

namespace app\models\product;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\product\Sklad;

/**
 * SkladSearch represents the model behind the search form of `app\models\product\Sklad`.
 */
class SkladSearch extends Sklad
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'region_id_sk'], 'integer'],
            [['name_sk', 'adress_sk', 'phone_sk', 'responsible_sk'], 'safe'],
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
        $query = Sklad::find();

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
            'region_id_sk' => $this->region_id_sk,
        ]);

        $query->andFilterWhere(['like', 'name_sk', $this->name_sk])
            ->andFilterWhere(['like', 'adress_sk', $this->adress_sk])
            ->andFilterWhere(['like', 'phone_sk', $this->phone_sk])
            ->andFilterWhere(['like', 'responsible_sk', $this->responsible_sk]);

        return $dataProvider;
    }
}
