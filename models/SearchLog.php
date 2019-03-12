<?php

namespace app\models;

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
            [['session_id', 'user_id', 'keyword', 'ip', 'created_at', 'updated_at'], 'required'],
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
    public function getSan(){
        $data = $this->user;
        return isset($data) ? $data->username : "";
    }
    public function getUser()
    {
        return $this->hasOne(\app\models\User::className(), ['id' => 'user_id']);
    }
}
