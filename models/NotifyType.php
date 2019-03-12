<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%notify_type}}".
 *
 * @property int $id
 * @property string $notfy_name
 * @property string $notfy_template
 *
 * @property Notfications[] $notfications
 */
class NotifyType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%notify_type}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['notfy_name', 'notfy_template'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'notfy_name' => Yii::t('app', 'Notfy Name'),
            'notfy_template' => Yii::t('app', 'Notfy Template'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotfications()
    {
        return $this->hasMany(Notfications::className(), ['notfy_type_id' => 'id']);
    }
}
