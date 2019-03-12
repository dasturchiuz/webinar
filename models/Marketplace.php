<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\AttributeBehavior;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%marketplace}}".
 *
 * @property int $id
 * @property string $market_name
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class Marketplace extends \yii\db\ActiveRecord
{
    const STATUS_ON =1;
    const STATUS_OFF =-1;
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

        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%marketplace}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['market_name'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['market_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'market_name' => Yii::t('app', 'Название торговой точки'),
            'status' => Yii::t('app', 'Статус'),
            'created_at' => Yii::t('app', 'Создан'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
