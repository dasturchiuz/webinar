<?php
/**
 * Created by PhpStorm.
 * User: loock
 * Date: 3/4/19
 * Time: 1:11 PM
 */
namespace app\models\dealer;
use app\models\Product;
use yii\data\ActiveDataProvider;

class Dealer extends Product
{
    public function rules()
    {
        return [
            [['id', 'category_id', 'profile_id', 'amount', 'price_protsent', 'sort', 'manufacturer_id', 'type_product'], 'integer'],
            [['related_products', 'name', 'code', 'text', 'short_text', 'is_new', 'is_popular', 'feature_image', 'available', 'slug', 'region_id'], 'safe'],
            [['price', 'max_price', 'min_price'], 'number'],
        ];
    }



    public function searchDealer(){
        $query = Product::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['created_at' => SORT_DESC]]
        ]);
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
        ]);
        $this->available='yes';
        $query->andFilterWhere(['or', ['type_product' => Product::PRODUCT_TYPE_DILLER], ['type_product' => Product::PRODUCT_TYPE_ALL]])

            ->andFilterWhere(['like', 'available', $this->available]);
        $query->groupBy('user_id');
        return $dataProvider;

    }
}