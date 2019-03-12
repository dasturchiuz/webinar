<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\AttributeBehavior;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%no_customers}}".
 *
 * @property int $id
 * @property int $client_id
 * @property int $comment_id
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 */
class NoCustomers extends \yii\db\ActiveRecord
{
    const STATUS_NO=1;
    const STATUS_YES=2;
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
        return '{{%no_customers}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_id', 'created_at', 'updated_at', 'created_by', 'status'], 'required'],
            [['client_id', 'comment_id', 'created_at', 'updated_at', 'created_by', 'status', 'is_archive'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'client_id' => Yii::t('app', 'Клиент ID'),
            'comment_id' => Yii::t('app', 'Комментарии'),
            'created_at' => Yii::t('app', 'Создан в'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Агент'),
            'status' => Yii::t('app', 'Статус'),
        ];
    }

    public function getUser()
    {
        return $this->hasOne(\app\models\User::className(), ['id' => 'client_id']);
    }

    public function getProfile()
    {
        return $this->hasOne(\app\models\Profile::className(), ['user_id' => 'client_id']);
    }
    public function getCreated()
    {
        return $this->hasOne(\app\models\Profile::className(), ['user_id' => 'created_by']);
    }

    public function getComment(){
        $com= \app\models\CommentProfile::findOne($this->comment_id);
        if(!empty($com))
            return $com->com_text;
        else
            return "Комментарии нет";

    }


}
