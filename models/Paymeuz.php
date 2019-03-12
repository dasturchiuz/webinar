<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%payme_uz}}".
 *
 * @property int $id
 * @property string $transaction
 * @property string $code
 * @property string $state
 * @property string $owner_id
 * @property string $amount
 * @property string $reason
 * @property string $payme_time
 * @property string $cancel_time
 * @property string $create_time
 * @property string $perform_time
 */
class Paymeuz extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%payme_uz}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['transaction'], 'string', 'max' => 50],
            [['created_by','owner_id', 'order_id'], 'integer'],
            [['code', 'state',  'amount', 'reason', 'payme_time', 'cancel_time', 'create_time', 'perform_time'], 'string', 'max' => 25],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'transaction' => Yii::t('app', 'Transaction'),
            'code' => Yii::t('app', 'Code'),
            'state' => Yii::t('app', 'State'),
            'owner_id' => Yii::t('app', 'Owner ID'),
            'amount' => Yii::t('app', 'Amount'),
            'reason' => Yii::t('app', 'Reason'),
            'order_id' => Yii::t('app', 'Order id'),
            'created_by' => Yii::t('app', 'created_by id'),
            'payme_time' => Yii::t('app', 'Payme Time'),
            'cancel_time' => Yii::t('app', 'Cancel Time'),
            'create_time' => Yii::t('app', 'Create Time'),
            'perform_time' => Yii::t('app', 'Perform Time'),
        ];
    }
}
