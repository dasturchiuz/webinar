<?php

namespace app\models;

use Yii;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "{{%comment_profile}}".
 *
 * @property int $id
 * @property string $com_text
 * @property int $sts
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $profile_id
 */
class CommentProfile extends \yii\db\ActiveRecord
{

    public function behaviors(){
        return [
            [
                'class'=>TimestampBehavior::className(),
                'attributes'=>[
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT=>['created_at', 'updated_at'],
                    \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE=>['updated_at'],
                ],
                'value'=>function(){ return date('U');},
            ],
            [
                'class'=>AttributeBehavior::className(),
                'attributes'=>[
                    ActiveRecord::EVENT_BEFORE_INSERT=>['created_by'],
                ],
                'value' => function ($event) {
                    return Yii::$app->user->getId()!=0 ? Yii::$app->user->getId() : 0;
                },
            ],

            [
                'class'=>AttributeBehavior::className(),
                'attributes'=>[
                    ActiveRecord::EVENT_BEFORE_INSERT=>['sts'],
                ],
                'value' => function ($event) {
                    return 1;
                },
            ],


        ];
    }


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%comment_profile}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['com_text',], 'required'],
            [['com_text'], 'string'],
            [['sts', 'created_at', 'updated_at', 'created_by', 'profile_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'com_text' => Yii::t('app', 'Коментарий'),
            'sts' => Yii::t('app', 'Sts'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'profile_id' => Yii::t('app', 'Profile ID'),
        ];
    }

    protected function getCreated(){
        return $this->hasOne(\app\models\Profile::className(), ['user_id' => 'created_by']);
    }

    public function getKemnapisan(){
        $profile=$this->created;
        if(!empty($profile))
        {
            return $profile->fullnameemp;
        }else{
            return "Ananim";
        }
    }
}
