<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Product;

/**
 * ProductSearch represents the model behind the search form of `app\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'profile_id', 'amount', 'price_protsent', 'sort'], 'integer'],
            [['related_products', 'name', 'code', 'text', 'short_text', 'is_new', 'is_popular', 'feature_image', 'available', 'slug'], 'safe'],
            [['price'], 'number'],
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
        $query = Product::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['created_at'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

//        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'profile_id' => $this->profile_id,
            'amount' => $this->amount,
            'price' => $this->price,
            'price_protsent' => $this->price_protsent,
            'sort' => $this->sort,
        ]);

        $query->andFilterWhere(['like', 'related_products', $this->related_products])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like', 'short_text', $this->short_text])
            ->andFilterWhere(['like', 'is_new', $this->is_new])
            ->andFilterWhere(['like', 'is_popular', $this->is_popular])
            ->andFilterWhere(['like', 'feature_image', $this->feature_image])
            ->andFilterWhere(['like', 'available', $this->available]);
//            ->andFilterWhere(['like', 'slug', $this->slug]);

        return $dataProvider;
    }

    public function searchByUserId($user_id)
    {
        $query = Product::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['created_at'=>SORT_DESC]]
        ]);

        $query->where(['user_id'=>$user_id]);

        return $dataProvider;
    }
}
