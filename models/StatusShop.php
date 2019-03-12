<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%status_shop}}".
 *
 * @property int $id
 * @property string $name
 * @property int $sts
 */
class StatusShop extends \yii\db\ActiveRecord
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
        return '{{%status_shop}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', ], 'required'],
            [['sts'], 'integer'],
            [['name'], 'string', 'max' => 255],
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
