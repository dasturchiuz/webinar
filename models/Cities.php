<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%cities}}".
 *
 * @property int $id
 * @property string $city_name
 * @property int $region_id
 * @property int $sort_city
 *
 * @property Adresses[] $adresses
 * @property Regions $region
 */
class Cities extends \yii\db\ActiveRecord
{
    public $strana_id;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%cities}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['region_id', 'sort_city', 'strana_id'], 'integer'],
            [['city_name'], 'string', 'max' => 100],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => Regions::className(), 'targetAttribute' => ['region_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'city_name' => Yii::t('app', 'City Name'),
            'region_id' => Yii::t('app', 'Region ID'),
            'sort_city' => Yii::t('app', 'Sort City'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdresses()
    {
        return $this->hasMany(Adresses::className(), ['city_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Regions::className(), ['id' => 'region_id']);
    }
}
