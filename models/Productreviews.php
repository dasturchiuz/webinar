<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%product_reviews}}".
 *
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @property int $star_rating
 * @property string $otziv_text
 * @property int $status
 *
 * @property Product $product
 * @property Profile $user
 */
class Productreviews extends \yii\db\ActiveRecord
{
    const STATUS_NEW = 0;
    const STATUS_COMPLETED =1;
    public function behaviors(){
        return [
            [
                'class'=>TimestampBehavior::className(),
                'attributes'=>[
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT=>['created_at', 'updated_at'],
                    \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE=>['updated_at'],
                ],
                'value'=>function(){ return date('U');},
            ],

        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%product_reviews}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'safe'],
            [['user_id', 'product_id', 'star_rating', 'otziv_text'], 'required'],
            [['user_id', 'product_id', 'star_rating', 'status'], 'integer'],
            [['otziv_text'], 'string', 'max' => 500],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['user_id' => 'user_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'Пользователь'),
            'product_id' => Yii::t('app', 'Название продукта'),
            'star_rating' => Yii::t('app', 'Оцените товар'),
            'otziv_text' => Yii::t('app', 'Поле для текста'),
            'status' => Yii::t('app', 'Статус'),
            'created_at' => Yii::t('app', 'Cоздан в '),
        ];
    }
    public static function getStatuses()
    {
        return [
            self::STATUS_NEW => 'Новый',
            self::STATUS_COMPLETED =>'Потдверждено' ,
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
    public function getUser()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'user_id']);
    }
}
