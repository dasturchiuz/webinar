<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%order_item}}".
 *
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property string $name
 * @property double $price
 * @property int $qty_item
 * @property double $summ_item
 *
 * @property Orders $order
 * @property Product $product
 */
class Orderitem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%order_item}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'product_id'], 'required'],
            [['order_id', 'product_id', 'qty_item', 'discount_procent', 'discount_id'], 'integer'],
            [['price', 'summ_item'], 'number'],
            [['name', 'discount_name'], 'string', 'max' => 255],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Orders::className(), 'targetAttribute' => ['order_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'order_id' => Yii::t('app', 'Order ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'name' => Yii::t('app', 'Name'),
            'price' => Yii::t('app', 'Price'),
            'qty_item' => Yii::t('app', 'Qty Item'),
            'summ_item' => Yii::t('app', 'Summ Item'),
            'discount_name' => Yii::t('app', 'Summ Item'),
            'discount_id' => Yii::t('app', 'Summ Item'),
            'discount_procent' => Yii::t('app', 'Summ Item'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Orders::className(), ['id' => 'order_id']);
    }

    public function getDiscount(){
        if($this->discount_id!=null){
            return "<strong>-".$this->discount_procent. "%</strong><br>". $this->discount_name ;
        }else{
            return false;
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
