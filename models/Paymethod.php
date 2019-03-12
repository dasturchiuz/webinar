<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%pay_method}}".
 *
 * @property int $id
 * @property string $pay_name
 * @property int $payment_status
 */
class Paymethod extends \yii\db\ActiveRecord
{
    //delever id qachonki sposob oplatada tipi 1 ga teng bulganda chiqaradi

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%pay_method}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pay_name', 'delivery_id'], 'required'],
            [['payment_status'], 'integer'],
            [['pay_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'pay_name' => Yii::t('app', 'Pay Name'),
            'payment_status' => Yii::t('app', 'Payment Status'),
            'delivery_id' => Yii::t('app', 'delivery_id'),
        ];
    }
}
