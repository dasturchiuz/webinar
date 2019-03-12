<?php

namespace app\models;

<<<<<<< HEAD
=======
use Yii;
>>>>>>> origin/master
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Category;

/**
 * CategorySearch represents the model behind the search form of `app\models\Category`.
 */
class CategorySearch extends Category
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
<<<<<<< HEAD
            [['id'], 'integer'],
            [['title'], 'safe'],
=======
            [['id', 'parent_id', 'sort'], 'integer'],
            [['name', 'code', 'slug', 'text', 'image'], 'safe'],
>>>>>>> origin/master
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
        $query = Category::find();

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
<<<<<<< HEAD
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);
=======
            'parent_id' => $this->parent_id,
            'sort' => $this->sort,
        ]);

       $query->andFilterWhere(['like', 'name', $this->name]);
//            ->andFilterWhere(['like', 'code', $this->code])
//            ->andFilterWhere(['like', 'slug', $this->slug])
//            ->andFilterWhere(['like', 'text', $this->text])
//            ->andFilterWhere(['like', 'image', $this->image]);
>>>>>>> origin/master

        return $dataProvider;
    }
}
