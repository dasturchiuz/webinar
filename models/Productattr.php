<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%product_attr}}".
 *
 * @property int $id
 * @property int $product_id
 * @property string $attr_name_id
 * @property string $attr_name
 * @property string $attr_value
 * @property int $is_group
 * @property int $is_filter
 * @property int $is_main
 *
 * @property Product $product
 */
class Productattr extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%product_attr}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'is_group', 'is_filter', 'is_main'], 'integer'],
            [['is_main'], 'required'],
            [['attr_name_id', 'attr_name', 'attr_value'], 'string', 'max' => 255],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'attr_name_id' => Yii::t('app', 'Значение атрибута'),
            'attr_name' => Yii::t('app', 'Имя атрибута'),
            'attr_value' => Yii::t('app', 'Значение атрибута'),
            'is_group' => Yii::t('app', 'Группа?'),
            'is_filter' => Yii::t('app', 'Фильтр?'),
            'is_main' => Yii::t('app', 'Главная?'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
