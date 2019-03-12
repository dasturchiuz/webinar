<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%strana}}".
 *
 * @property int $id
 * @property string $strana_name
 * @property int $sort_strana
 *
 * @property Adresses[] $adresses
 * @property Regions[] $regions
 */
class Strana extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%strana}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sort_strana'], 'integer'],
            [['strana_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'strana_name' => Yii::t('app', 'Страны'),
            'sort_strana' => Yii::t('app', 'Sort Strana'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdresses()
    {
        return $this->hasMany(Adresses::className(), ['strana_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegions()
    {
        return $this->hasMany(Regions::className(), ['strana_id' => 'id']);
    }
}
