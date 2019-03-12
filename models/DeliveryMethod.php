<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%delivery_method}}".
 *
 * @property int $id
 * @property string $deliver_name
 * @property int $status
 * @property int $delevery_type
 */
class DeliveryMethod extends \yii\db\ActiveRecord
{
    /*
     * delivery_type 1 ga teng bo'lsa tegishli dastavka turlarini chiqarsin
     * 0 ga teng bo'lsa barcha methodlar chiqsin
     *
     * */
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%delivery_method}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['deliver_name'], 'required'],
            [['status', 'delevery_type'], 'integer'],
            [['deliver_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'deliver_name' => Yii::t('app', 'Название доставки'),
            'status' => Yii::t('app', 'Статус'),
            'delevery_type' => Yii::t('app', 'Типы доставки'),
        ];
    }
}
