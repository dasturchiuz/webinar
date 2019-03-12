<?php

namespace app\models;

use Yii;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "{{%discount}}".
 *
 * @property int $id
 * @property int $product_id
 * @property int $discount_name
 * @property int $price_procent
 * @property string $date_strat
 * @property string $date_int
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 */
class Discount extends \yii\db\ActiveRecord
{
    const STATUS_OK=10;
    const STATUS_CONCEL=1;
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
            [
                'class'=>AttributeBehavior::className(),
                'attributes'=>[
                    ActiveRecord::EVENT_BEFORE_INSERT=>['created_by'],
                ],
                'value' => function ($event) {
                    return Yii::$app->user->getId();
                },
            ],

            [
                'class'=>AttributeBehavior::className(),
                'attributes'=>[
                    ActiveRecord::EVENT_BEFORE_INSERT=>['status'],
                ],
                'value' => function ($event) {
                    return 1;
                },
            ],


        ];
    }

    public static function ByStatus($query, $sts){
        $query->andWhere('now() between date_start  AND date_end AND status="'.$sts.'"');
    }

    public static function getStatuses(){
        return [
            self::STATUS_OK=>"Активный",
            self::STATUS_CONCEL => "Неактивный",
        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%discount}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['product_id', 'discount_name', 'price_procent', 'date_strat', 'date_int'], 'required', 'message'=>'{attribute} не может быть пустым.'],
            [['product_id',  'price_procent', 'created_at', 'updated_at', 'created_by', 'status'], 'integer', 'message'=>'{attribute}  должно быть целым числом.'],
            [['discount_name'], 'string', 'max'=>25],
            [['date_start', 'date_end'], 'safe'],
            [['date_start', 'date_end'], 'date', 'format'=>'Y-m-d']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'discount_name' => Yii::t('app', 'Название скидки'),
            'price_procent' => Yii::t('app', 'Проценты'),
            'date_start' => Yii::t('app', 'Дата начала'),
            'date_end' => Yii::t('app', 'Дата окончания'),
            'created_at' => Yii::t('app', 'Created At'),
            'status' => Yii::t('app', 'Статус'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
        ];
    }
}
