<?php

namespace app\modules\administration\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\administration\models\Employees;

/**
 * EmployeesSearch represents the model behind the search form of `app\modules\administration\models\Employees`.
 */
class EmployeesSearch extends Employees
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id',  'created_at', 'updated_at', 'user_id'], 'integer'],
            [['surname', 'role', 'firstname', 'fathername', 'adress', 'tell', 'last_activity_time'], 'safe'],
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
        $query = Employees::find();

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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user_id' => $this->user_id,
            'role' => $this->role,
            'last_activity_time' => $this->last_activity_time,
        ]);

        $query->andFilterWhere(['like', 'surname', $this->surname])
            ->andFilterWhere(['like', 'firstname', $this->firstname])
            ->andFilterWhere(['like', 'fathername', $this->fathername])
            ->andFilterWhere(['like', 'adress', $this->adress])
            ->andFilterWhere(['like', 'tell', $this->tell]);

        return $dataProvider;
    }
}
