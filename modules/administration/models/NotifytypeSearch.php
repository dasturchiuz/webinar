<?php

namespace app\modules\administration\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\NotifyType;

/**
 * NotifytypeSearch represents the model behind the search form of `app\models\NotifyType`.
 */
class NotifytypeSearch extends NotifyType
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['notfy_name', 'notfy_template'], 'safe'],
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
        $query = NotifyType::find();

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
        ]);

        $query->andFilterWhere(['like', 'notfy_name', $this->notfy_name])
            ->andFilterWhere(['like', 'notfy_template', $this->notfy_template]);

        return $dataProvider;
    }
}
