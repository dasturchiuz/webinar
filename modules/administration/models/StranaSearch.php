<?php

namespace app\modules\administration\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Strana;

/**
 * StranaSearch represents the model behind the search form of `app\models\Strana`.
 */
class StranaSearch extends Strana
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'sort_strana'], 'integer'],
            [['strana_name'], 'safe'],
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
        $query = Strana::find();

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
            'sort_strana' => $this->sort_strana,
        ]);

        $query->andFilterWhere(['like', 'strana_name', $this->strana_name]);

        return $dataProvider;
    }
}
