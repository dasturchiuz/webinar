<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%organization}}".
 *
 * @property int $id
 * @property string $name
 * @property int $sts
 */
class Organization extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE=1;
    const STATUS_OFF=0;

    public static function getStatuses(){
        return [
            self::STATUS_ACTIVE=>"Активный",
            self::STATUS_OFF=>"Неактивный",
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%organization}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'sts'], 'required'],
            [['sts'], 'integer'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'sts' => Yii::t('app', 'Sts'),
        ];
    }
}
