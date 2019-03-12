<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%adresses}}".
 *
 * @property int $id
 * @property int $strana_id
 * @property int $oblast_id
 * @property int $city_id
 * @property int $pochta_index
 * @property string $street
 * @property string $house
 * @property string $room
 * @property string $orientir
 *
 * @property Cities $city
 * @property Regions $oblast
 * @property Strana $strana
 */
class Adresses extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%adresses}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['strana_id', 'oblast_id', 'city_id', 'pochta_index', 'profile_id'], 'integer'],
            [['street', 'orientir'], 'string', 'max' => 255],
            [['house', 'room'], 'string', 'max' => 50],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::className(), 'targetAttribute' => ['city_id' => 'id']],
            [['oblast_id'], 'exist', 'skipOnError' => true, 'targetClass' => Regions::className(), 'targetAttribute' => ['oblast_id' => 'id']],
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
            'strana_id' => Yii::t('app', 'Страна'),
            'profile_id' => Yii::t('app', 'Область'),
            'oblast_id' => Yii::t('app', 'Область'),
            'city_id' => Yii::t('app', 'Город'),
            'pochta_index' => Yii::t('app', 'Индекс'),
            'street' => Yii::t('app', 'Улица (посёлок)'), 
            'house' => Yii::t('app', 'Дом'),
            'room' => Yii::t('app', 'Квартира'),
            'orientir' => Yii::t('app', 'Ориентир'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(Cities::className(), ['id' => 'city_id']);
    }

    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'profile_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOblast()
    {
        return $this->hasOne(Regions::className(), ['id' => 'oblast_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStrana()
    {
        return $this->hasOne(Strana::className(), ['id' => 'strana_id']);
    }
}
