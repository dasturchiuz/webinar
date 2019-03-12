<?php

namespace app\models\product;

use Yii;

/**
 * This is the model class for table "{{%search_log}}".
 *
 * @property int $id
 * @property string $session_id
 * @property int $user_id
 * @property string $keyword
 * @property string $ip
 * @property int $created_at
 * @property int $updated_at
 */
class SearchLog extends \yii\db\ActiveRecord
{
    public function behaviors(){
        return [
            [
                'class'=>\yii\behaviors\TimestampBehavior::className(),
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
        return '{{%search_log}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['session_id', 'keyword',], 'required'],
            [['user_id', 'created_at', 'updated_at'], 'integer'],
            [['session_id', 'keyword', 'ip'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'session_id' => Yii::t('app', 'Session ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'keyword' => Yii::t('app', 'Keyword'),
            'ip' => Yii::t('app', 'Ip'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
