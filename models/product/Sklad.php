<?php

namespace app\models\product;

use Yii;

/**
 * This is the model class for table "{{%sklad}}".
 *
 * @property int $id
 * @property string $name_sk
 * @property int $region_id_sk
 * @property string $adress_sk
 * @property string $phone_sk
 * @property string $responsible_sk
 */
class Sklad extends \yii\db\ActiveRecord
{
    public $strana_id;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%sklad}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_sk', 'region_id_sk', 'adress_sk', 'phone_sk', 'responsible_sk'], 'required'],
            [['region_id_sk'], 'integer'],
            [['name_sk'], 'string', 'max' => 200],
            [['adress_sk'], 'string', 'max' => 255],
            [['phone_sk'], 'string', 'max' => 15],
            [['responsible_sk'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name_sk' => Yii::t('app', 'Наименование склад'),
            'region_id_sk' => Yii::t('app', 'Область склад  '),
            'adress_sk' => Yii::t('app', 'Адрес склада'),
            'phone_sk' => Yii::t('app', 'Телефон ответственное лицо'),
            'responsible_sk' => Yii::t('app', 'Ответственное лицо'),
        ];
    }
}
