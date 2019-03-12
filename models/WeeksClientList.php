<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "{{%weeks_client_list}}".
 *
 * @property int $id
 * @property int $week_number
 * @property int $client_id
 * @property int $user_id
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $status
 */
class WeeksClientList extends \yii\db\ActiveRecord
{
    const ROLE_AGENT=1;
    const ROLE_COURER=2;
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
        return '{{%weeks_client_list}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['week_number', 'client_id', 'user_id',  'status'], 'required'],
            [['week_number', 'client_id', 'user_id', 'created_at', 'updated_at', 'created_by', 'status', 'role_type'], 'integer'],
        ];
    }

    public function getUser(){
        return $this->hasOne(\app\models\Profile::className(), ['user_id'=>'user_id']);
    }

    public function getProfile(){
        return $this->hasOne(\app\models\Profile::className(), ['user_id'=>'user_id']);
    }

    public function getCreated(){
        return $this->hasOne(\app\models\Profile::className(), ['user_id'=>'created_by']);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'week_number' => Yii::t('app', 'День недели'),
            'client_id' => Yii::t('app', 'Клиент'),
            'user_id' => Yii::t('app', 'Агент или Курьер'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'role_type'=>'Usertype',
            'created_by' => Yii::t('app', 'Created By'),
            'status' => Yii::t('app', 'Status'),
        ];
    }
}
