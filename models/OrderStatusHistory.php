<?php

namespace app\models;

use Yii;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use app\models\Profile;

/**
 * This is the model class for table "{{%order_status_history}}".
 *
 * @property int $id
 * @property int $status
 * @property int $order_id
 * @property int $notfy_client
 * @property string $comment_status
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 */
class OrderStatusHistory extends \yii\db\ActiveRecord
{
    public function behaviors(){
        return [

            [
                'class'=>AttributeBehavior::className(),
                'attributes'=>[
                    ActiveRecord::EVENT_BEFORE_INSERT=>['created_by'],
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
        return '{{%order_status_history}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'order_id', 'notfy_client', 'created_at', 'updated_at', 'created_by'], 'integer'],
            [['comment_status', 'status'], 'required'],
            [['comment_status'], 'string', 'max' => 300],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'status' => Yii::t('app', 'Положение дел'),
            'order_id' => Yii::t('app', 'Order ID'),
            'notfy_client' => Yii::t('app', 'Уведомление клиента'),
            'comment_status' => Yii::t('app', 'Комментарий'),
            'created_at' => Yii::t('app', 'Дата Добавлена'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Пользователь'),
        ];
    }

    public function getUser(){
        return $this->hasOne(Profile::className(), ['user_id'=> 'created_by']);
    }
}
