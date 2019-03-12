<?php

namespace app\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\behaviors\AttributeBehavior;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%invoices}}".
 *
 * @property int $id
 * @property int $order_id
 * @property string $in_date
 * @property string $in_desc
 * @property int $pay_id
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 * @property double $amount
 * @property int $status
 *
 * @property Orders $order
 * @property Profile $createdBy
 * @property Profile $updatedBy
 */
class Invoices extends \yii\db\ActiveRecord
{
    public function behaviors(){
        return [
            [
                'class'=>TimestampBehavior::className(),
                'attributes'=>[
                    ActiveRecord::EVENT_BEFORE_INSERT=>['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE=>['updated_at'],
                ],
                'value'=>function(){ return date('U');},
            ],

//            [
//                'class'=>AttributeBehavior::className(),
//                'attributes'=>[
//                    ActiveRecord::EVENT_BEFORE_INSERT=>['created_by'],
//                ],
//                'value' => function ($event) {
//                    return Yii::$app->user->getId();
//                },
//            ],
//            [
//                'class'=>AttributeBehavior::className(),
//                'attributes'=>[
//                    ActiveRecord::EVENT_BEFORE_UPDATE=>['updated_by'],
//                ],
//                'value' => function ($event) {
//                    return Yii::$app->user->getId();
//                },
//            ],

        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%invoices}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'in_date', 'in_desc', 'pay_id', 'amount', 'status'], 'required'],
            [['order_id', 'pay_id', 'created_by', 'updated_by', 'created_at', 'updated_at', 'status', 'transaction_id'], 'integer'],
            [['created_by', 'updated_by', 'created_at', 'updated_at','in_date' ], 'safe'],
            [['in_desc'], 'string'],
            [['amount'], 'number'],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Orders::className(), 'targetAttribute' => ['order_id' => 'id']],
//            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['created_by' => 'user_id']],
//            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['updated_by' => 'user_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'order_id' => Yii::t('app', 'Номер заказ'),
            'in_date' => Yii::t('app', 'Дата'),
            'in_desc' => Yii::t('app', 'Комментарии'),
            'pay_id' => Yii::t('app', 'Способ оплаты '),
            'created_by' => Yii::t('app', 'Курьер'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'transaction_id' => Yii::t('app', 'transaction_id At'),
            'amount' => Yii::t('app', 'Сумма'),
            'status' => Yii::t('app', 'Состояние'),
        ];
    }



    public function getPay()
    {
        return $this->hasOne(\app\models\Paymethod::className(), ['id' => 'pay_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Orders::className(), ['id' => 'order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'updated_by']);
    }
}
