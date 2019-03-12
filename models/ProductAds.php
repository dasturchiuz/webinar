<?php

namespace app\models;

use Yii;
use app\models\Product;
use app\models\Profile;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\AttributeBehavior;

/**
 * This is the model class for table "product_ads".
 *
 * @property int $id
 * @property int $seller_id
 * @property int $product_id
 * @property int $type_ads
 * @property int $sts
 * @property int $created_at
 * @property int $created_by
 *
 * @property Product $product
 * @property Profile $seller
 */
class ProductAds extends ActiveRecord
{
    public function behaviors()
    {
        return [
            [
                'class'=>TimestampBehavior::className(),
                'attributes'=>[
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT =>['created_at']
                ],
                'value'=>function($event){
                    return date('U');
                }
            ],
            [
                'class'=>AttributeBehavior::className(),
                'attributes'=>[
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['created_by']
                ],
                'value'=>function($event){
                    return Yii::$app->user->identity->id;
                }
            ],
            [
                'class'=>AttributeBehavior::className(),
                'attributes'=>[
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['sts']
                ],
                'value'=>function($event){
                    return 1;
                }
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_ads';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['seller_id', 'product_id', 'type_ads', 'price_ads'], 'required'],
            [['seller_id', 'product_id', 'type_ads', 'sts', 'created_at', 'created_by'], 'integer'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['seller_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['seller_id' => 'user_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'seller_id' => Yii::t('app', 'Seller ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'type_ads' => Yii::t('app', 'Type Ads'),
            'sts' => Yii::t('app', 'Sts'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'price_ads' => Yii::t('app', 'price_ads'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeller()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'seller_id']);
    }
}
