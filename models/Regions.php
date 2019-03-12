<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%regions}}".
 *
 * @property int $id
 * @property string $name_obl
 * @property int $strana_id
 * @property int $status
 *
 * @property Adresses[] $adresses
 * @property Cities[] $cities
 * @property Orders[] $orders
 * @property Strana $strana
 */
class Regions extends \yii\db\ActiveRecord
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
        return '{{%regions}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_obl'], 'required'],
            [['strana_id', 'status'], 'integer'],
            [['name_obl'], 'string', 'max' => 64],
            [['strana_id'], 'exist', 'skipOnError' => true, 'targetClass' => Strana::className(), 'targetAttribute' => ['strana_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name_obl' => Yii::t('app', 'Названи'),
            'strana_id' => Yii::t('app', 'Страна'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdresses()
    {
        return $this->hasMany(Adresses::className(), ['oblast_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCities()
    {
        return $this->hasMany(Cities::className(), ['region_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['region_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStrana()
    {
        return $this->hasOne(Strana::className(), ['id' => 'strana_id']);
    }
}
