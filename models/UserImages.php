<?php

namespace app\models;

use Yii;
use app\models\Profile;

/**
 * This is the model class for table "user_images".
 *
 * @property int $id
 * @property string $path_to_file
 * @property string $mimeType
 * @property int $user_id
 *
 * @property Profile $user
 */
class UserImages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_images';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['path_to_file', 'mimeType', 'user_id'], 'required'],
            [['user_id'], 'integer'],
            [['path_to_file'], 'string', 'max' => 255],
            [['mimeType'], 'string', 'max' => 50],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['user_id' => 'user_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'path_to_file' => Yii::t('app', 'Path To File'),
            'mimeType' => Yii::t('app', 'Mime Type'),
            'user_id' => Yii::t('app', 'User ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'user_id']);
    }
    public function getLogo(){

        return Yii::$app->response->sendFile($this->path_to_file)->send();
    }
    public function getImg(){
        \Yii::$app->response->format = yii\web\Response::FORMAT_RAW;
        \Yii::$app->response->headers->add('content-type', $this->mimeType);
        \Yii::$app->response->data = file_get_contents($this->path_to_file);
        return \Yii::$app->response;
    }
}
