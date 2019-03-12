<?php

namespace app\models;

use Yii;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\TimestampBehavior;

use yii\db\ActiveRecord;
/**
 * This is the model class for table "{{%notfications}}".
 *
 * @property int $id
 * @property int $notfy_type_id
 * @property int $profile_id
 * @property int $is_read
 * @property string $notfy_text
 * @property int $created_at
 * @property int $receive_at
 * @property int $created_by
 *
 * @property Profile $profile
 * @property NotifyType $notfyType
 */
class Notfications extends \yii\db\ActiveRecord
{
    public function behaviors(){
        return [
            [
                'class'=>TimestampBehavior::className(),
                'attributes'=>[
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT=>['created_at'],
                    \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE=>['receive_at'],
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


        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%notfications}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['notfy_type_id', 'profile_id', 'is_read', 'created_at', 'receive_at', 'created_by'], 'integer'],
            [['notfy_text'], 'string'],
            [['profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['profile_id' => 'user_id']],
            [['notfy_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => NotifyType::className(), 'targetAttribute' => ['notfy_type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'notfy_type_id' => Yii::t('app', 'Тип уведомления'),
            'profile_id' => Yii::t('app', 'Profile ID'),
            'is_read' => Yii::t('app', 'Is Read'),
            'notfy_text' => Yii::t('app', 'Notfy Text'),
            'created_at' => Yii::t('app', 'Created At'),
            'receive_at' => Yii::t('app', 'Receive At'),
            'created_by' => Yii::t('app', 'Created By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'profile_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotfyType()
    {
        return $this->hasOne(NotifyType::className(), ['id' => 'notfy_type_id']);
    }
}
