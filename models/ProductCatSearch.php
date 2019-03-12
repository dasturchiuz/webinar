<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Product;

/**
 * ProductSearch represents the model behind the search form of `app\models\Product`.
 */
class ProductCatSearch extends Product
{
    public $max_price;
    public $min_price;
    public $star_product;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'profile_id', 'amount', 'price_protsent', 'sort', 'manufacturer_id', 'type_product'], 'integer'],
            [['related_products', 'name', 'code', 'text', 'short_text', 'is_new', 'is_popular', 'feature_image', 'available', 'slug', 'region_id', 'star_product'], 'safe'],
            [['price', 'max_price', 'min_price'], 'number'],
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
    public function search($params, $cat_ids)
    {
        $query = Product::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['created_at' => SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        //dostupniy bo'lganlarinigina sotuvga chiqariladi
        $this->available = 'yes';
        if (isset($params['brand'])) {
            $this->manufacturer_id = $params['brand'];
        }

        if (isset($params['sort'])) {
            if ($params['sort'] == 'name') {
                $dataProvider->setSort([
                    'defaultOrder' => ['name' => SORT_ASC],
                ]);
            }
            if ($params['sort'] == 'views') {
                $dataProvider->setSort([
                    'defaultOrder' => ['view_count' => SORT_DESC],
                ]);
            }


        }


        if($this->star_product>1){
            $query->joinWith([
                'reviews'=>function($q){
                    $q->alias('r');
                    $q->having(['>=', 'AVG(r.star_rating)', $this->star_product]);
                    $q->groupby('r.product_id');
                    //        return Yii::$app->db->createCommand("SELECT AVG(star_rating) as star FROM product_reviews WHERE product_id='".$this->id."'")->queryOne()['star'];
                }
            ]);
        }


//        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $cat_ids,
            'profile_id' => $this->profile_id,
            'manufacturer_id' => $this->manufacturer_id,
            'amount' => $this->amount,
            'price' => $this->price,
            'price_protsent' => $this->price_protsent,
            'sort' => $this->sort,
            'type_product' => Product::PRODUCT_TYPE_SELLER
        ]);

        $query->andFilterWhere(['like', 'related_products', $this->related_products])
            ->andFilterWhere(['or', ['type_product' => Product::PRODUCT_TYPE_SELLER], ['type_product' => Product::PRODUCT_TYPE_ALL]])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like', 'short_text', $this->short_text])
            ->andFilterWhere(['like', 'is_new', $this->is_new])
            ->andFilterWhere(['like', 'is_popular', $this->is_popular])
            ->andFilterWhere(['like', 'feature_image', $this->feature_image])
            ->andFilterWhere(['like', 'available', $this->available]);
//            ->andFilterWhere(['like', 'slug', $this->slug]);

        //filter summa buyicha
        if ($this->max_price > 0 and $this->min_price > 0) {
            $query->andFilterWhere(['between', 'price', $this->min_price, $this->max_price]);
        }

        if ($this->region_id) {
            $query->andFilterWhere(['in', 'region_id', $this->region_id]);
        }


        return $dataProvider;
    }

    public function searchIndex($params)
    {
        $query = Product::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['created_at' => SORT_DESC]],
            'pagination' => [
                //'pageSize'=>12,
                'pageParam' => 'page',
                'defaultPageSize' => 12,
                'forcePageParam' => false,
            ],
            'sort' => ['defaultOrder' => ['created_at' => SORT_DESC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        //dostupniy bo'lganlarinigina sotuvga chiqariladi
        $this->available = 'yes';
        if($this->star_product>1){
            $query->joinWith([
                'reviews'=>function($q){
                    $q->alias('r');
                    $q->having(['>=', 'AVG(r.star_rating)', $this->star_product]);
                    $q->groupby('r.product_id');
                    //        return Yii::$app->db->createCommand("SELECT AVG(star_rating) as star FROM product_reviews WHERE product_id='".$this->id."'")->queryOne()['star'];
                }
            ]);
        }


        if (isset($params['sort'])) {
            if ($params['sort'] == 'name') {
                $dataProvider->setSort([
                    'defaultOrder' => ['name' => SORT_ASC],
                ]);
            }
            if ($params['sort'] == 'views') {
                $dataProvider->setSort([
                    'defaultOrder' => ['view_count' => SORT_DESC],
                ]);
            }


        }
//        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'profile_id' => $this->profile_id,
            'manufacturer_id' => $this->manufacturer_id,
            //'amount' => $this->amount,
            //'price' => $this->price,
            //'price_protsent' => $this->price_protsent,
            //'sort' => $this->sort,
            //'type_product'=>Product::PRODUCT_TYPE_SELLER
        ]);

        $query->andFilterWhere(['like', 'related_products', $this->related_products])
            ->andFilterWhere(['or', ['type_product' => Product::PRODUCT_TYPE_SELLER], ['type_product' => Product::PRODUCT_TYPE_ALL]])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['or', ['type_product' => Product::PRODUCT_TYPE_SELLER], ['type_product' => Product::PRODUCT_TYPE_ALL]])
            ->andFilterWhere(['like', 'is_new', $this->is_new])
            ->andFilterWhere(['like', 'is_popular', $this->is_popular]);
//            ->andFilterWhere(['like', 'slug', $this->slug]);

        //filter summa buyicha
        if ($this->max_price > 0 and $this->min_price > 0) {
            $query->andFilterWhere(['between', 'price', $this->min_price, $this->max_price]);
        }

        if ($this->region_id) {
            $query->andFilterWhere(['in', 'region_id', $this->region_id]);
        }


        return $dataProvider;
    }

    public function searchInShop($params, $data_mass)
    {
        $query = Product::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['created_at' => SORT_DESC]],
            'pagination' => [
                //'pageSize'=>12,
                'pageParam' => 'page',
                'defaultPageSize' => 12,
                'forcePageParam' => false,
            ],
            'sort' => ['defaultOrder' => ['created_at' => SORT_DESC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        //dostupniy bo'lganlarinigina sotuvga chiqariladi
        $this->available = 'yes';
        $this->user_id = $data_mass['user_id'];
        if($this->star_product>1){
            $query->joinWith([
                'reviews'=>function($q){
                    $q->alias('r');
                    $q->having(['>=', 'AVG(r.star_rating)', $this->star_product]);
                    $q->groupby('r.product_id');
                    //        return Yii::$app->db->createCommand("SELECT AVG(star_rating) as star FROM product_reviews WHERE product_id='".$this->id."'")->queryOne()['star'];
                }
            ]);
        }

        if (isset($params['sort'])) {
            if ($params['sort'] == 'name') {
                $dataProvider->setSort([
                    'defaultOrder' => ['name' => SORT_ASC],
                ]);
            }
            if ($params['sort'] == 'views') {
                $dataProvider->setSort([
                    'defaultOrder' => ['view_count' => SORT_DESC],
                ]);
            }


        }
//        // grid filtering conditions
        $query->andFilterWhere([
//            'id' => $this->id,
//            'profile_id' => $this->profile_id,
            'manufacturer_id' => $this->manufacturer_id,
            //'amount' => $this->amount,
            //'price' => $this->price,
            //'price_protsent' => $this->price_protsent,
            //'sort' => $this->sort,
            //'type_product'=>Product::PRODUCT_TYPE_SELLER
        ]);

        $query->andFilterWhere(['like', 'related_products', $this->related_products])
            ->andFilterWhere(['or', ['type_product' => Product::PRODUCT_TYPE_SELLER], ['type_product' => Product::PRODUCT_TYPE_ALL]])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['or', ['type_product' => Product::PRODUCT_TYPE_SELLER], ['type_product' => Product::PRODUCT_TYPE_ALL]])
            ->andFilterWhere(['like', 'is_new', $this->is_new])
            ->andFilterWhere(['like', 'is_popular', $this->is_popular]);
//            ->andFilterWhere(['like', 'slug', $this->slug]);

        //filter summa buyicha
        if ($this->max_price > 0 and $this->min_price > 0) {
            $query->andFilterWhere(['between', 'price', $this->min_price, $this->max_price]);
        }


//        if ($this->region_id) {
//            $query->andFilterWhere(['in', 'region_id', $this->region_id]);
//        }


        return $dataProvider;
    }
}
