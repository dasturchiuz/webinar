<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%unit}}".
 *
 * @property int $id
 * @property string $unit_name
 * @property int $status
 * @property int $created_at
 * @property string $unit_desc
 * @property int $updated_at
 */
class Unit extends \yii\db\ActiveRecord
{
    const STATUS_ON = 10;
    const STATUS_OFF = 0;


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

        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%unit}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['unit_name', 'status'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['unit_name'], 'string', 'max' => 20],
            [['unit_desc'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'unit_name' => Yii::t('app', 'Единица измерения'),
            'status' => Yii::t('app', 'Статус'),
            'created_at' => Yii::t('app', 'Created At'),
            'unit_desc' => Yii::t('app', 'Единица измерения описание'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
