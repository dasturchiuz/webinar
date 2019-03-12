<?php

namespace app\models;

use Yii;
use yii\behaviors\SluggableBehavior;
/**
 * This is the model class for table "{{%manufacturer}}".
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string $img_logo
 * @property string $desc
 * @property string $slug
 *
 * @property Product[] $products
 */
class Manufacturer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public function behaviors(){
        return[
            [
                'class'=>SluggableBehavior::className(),
                'attribute'=>'name',
                'immutable'=>true,
                'ensureUnique'=>true,
            ]
        ];
    }

    public static function tableName()
    {
        return '{{%manufacturer}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'strana_id'], 'required'],
            [['img_logo', 'desc'], 'string'],
            [['name', 'slug'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 155],
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
            'name' => Yii::t('app', 'Бранд'),
            'code' => Yii::t('app', 'Код'),
            'img_logo' => Yii::t('app', 'Лого'),
            'desc' => Yii::t('app', 'Описание'),
            'slug' => Yii::t('app', 'Slug'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['manufacturer_id' => 'id']);
    }
}
