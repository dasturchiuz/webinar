<?php

namespace app\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\behaviors\AttributeBehavior;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%debitor}}".
 *
 * @property int $id
 * @property int $order_id
 * @property double $amount
 * @property int $profile_id
 * @property string $repay_date
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 */
class Debitor extends \yii\db\ActiveRecord
{
    //Состояние долг
    //0 - Neoplacheno - aktivniy
    //1 - oplatil - ne aktivniy

    const STATUS_NEW = 0;
    const STATUS_OFF = 1;

    public function behaviors(){
        return [
            [
                'class'=>TimestampBehavior::className(),
                'attributes'=>[
                    ActiveRecord::EVENT_BEFORE_INSERT=>['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE=>['updated_at'],
                ],
                'value'=>function(){ return date('Y-m-d H:i:s');},
            ],

            [
                'class'=>AttributeBehavior::className(),
                'attributes'=>[
                    ActiveRecord::EVENT_BEFORE_INSERT=>['created_by'],
                    ActiveRecord::EVENT_BEFORE_UPDATE=>['updated_by'],
                ],
                'value' => function ($event) {
                    return Yii::$app->user->getId();
                },
            ], 

        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%debitor}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'amount', 'profile_id', 'repay_date'], 'required'],
            [['order_id', 'profile_id', 'created_by', 'updated_by', 'status'], 'integer'],
            [['amount'], 'number'],
            [['repay_date', 'created_at', 'updated_at'], 'safe'],
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
            'amount' => Yii::t('app', 'Сумма'),
            'profile_id' => Yii::t('app', 'Клиент'),
            'repay_date' => Yii::t('app', 'Вернуть дата'),
            'created_by' => Yii::t('app', 'Создан в'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'status' => Yii::t('app', 'Состояние долг'),
        ];

    }

    public function getProfile()
    {
        return $this->hasOne(\app\models\Profile::className(), ['user_id' => 'profile_id']);
    }

    public function getWeeks()
    {
        return $this->hasMany(\app\models\WeeksClientList::className(), ['client_id' => 'profile_id']);
    }
    
    public function getOrders()
    {
        return $this->hasMany(\app\models\Orders::className(), ['user_id' => 'profile_id']);
    }
    public function getCreatedBy()
    {
        return $this->hasOne(\app\models\Profile::className(), ['user_id' => 'created_by']);
    }
    public function getCreated()
    {
        return $this->hasOne(\app\models\Profile::className(), ['user_id' => 'created_by']);
    }


}
