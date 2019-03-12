<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%juridical}}".
 *
 * @property int $id
 * @property string $tashkilot
 * @property string $bank
 * @property int $hisobraqam
 * @property int $inn
 * @property int $mfo
 * @property int $created_at
 * @property int $updated_at
 * @property int $oked
 * @property int $status_shop_id
 * @property int $orgo_id
 * @property string $main_name
 * @property string $okpo
 * @property string $coato
 *
 * @property User $id0
 */
class Juridical extends \yii\db\ActiveRecord
{
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
        return '{{%juridical}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tashkilot', 'bank', 'hisobraqam', 'inn', 'mfo', 'created_at', 'updated_at', 'status_shop_id', 'orgo_id', 'main_name', 'profile_id', 'brand_juridical'], 'required'],
            [[ 'mfo', 'created_at', 'updated_at', 'oked', 'status_shop_id', 'orgo_id', 'profile_id'], 'integer'],
            [['tashkilot'], 'string', 'max' => 255],
            [['bank', 'brand_juridical'], 'string', 'max' => 200],
            [['main_name'], 'string', 'max' => 100],
            [['okpo', 'coato'], 'string', 'max' => 50],
            [['contract_number','hisobraqam'], 'string', 'max' => 20],
            [['inn'], 'string', 'max' => 9],
            [['contract_date'], 'date'],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'contract_number' => Yii::t('app', 'Договор номер'),
            'contract_date' => Yii::t('app', 'Дата заключения договора'),
            'tashkilot' => Yii::t('app', 'Название организации'),
            'bank' => Yii::t('app', 'Название банка '),
            'hisobraqam' => Yii::t('app', 'Р/С организации'),
            'inn' => Yii::t('app', 'ИНН'),
            'mfo' => Yii::t('app', 'МФО'),
            'created_at' => Yii::t('app', 'Создан в	'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'oked' => Yii::t('app', 'ОКЭД'),
            'status_shop_id' => Yii::t('app', 'Bид деятельности'),
            'orgo_id' => Yii::t('app', 'Организация'),
            'main_name' => Yii::t('app', 'Main Name'),
            'okpo' => Yii::t('app', 'ОКПО'),
            'coato' => Yii::t('app', 'СОАТО'),
            'profile_id' => Yii::t('app', 'Coato'),
            'contract_number' => Yii::t('app', 'Контракт номер'),
            'brand_juridical' => Yii::t('app', 'Доп. наз (Торговля бренд)'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(User::className(), ['id' => 'id']);
    }

    public function getStatusshopp()
    {
        return $this->hasOne(\app\models\StatusShop::className(), ['id' => 'status_shop_id']);
    }

    public function getOrgon()
    {
        return $this->hasOne(\app\models\Organization::className(), ['id' => 'orgo_id']);
    }


}
