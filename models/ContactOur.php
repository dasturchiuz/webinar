<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%contact_our}}".
 *
 * @property int $id
 * @property string $client_name
 * @property string $theme_appeal
 * @property string $text_appeal
 */
class ContactOur extends \yii\db\ActiveRecord
{
    public $captcha;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%contact_our}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_name', 'theme_appeal', 'text_appeal', 'telefon', 'captcha'], 'required'],
            [['text_appeal', 'email'], 'string'],
            [['client_name'], 'string', 'max' => 50],
            [['theme_appeal'], 'string', 'max' => 255],
            //['captcha', 'captcha', 'captchaAction'=>\yii\helpers\Url::toRoute('/page/captcha'), 'message'=>'Неправилние']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'client_name' => Yii::t('app', 'Имя'),
            'theme_appeal' => Yii::t('app', 'Тема'),
            'email' => Yii::t('app', 'Эл. адрес'),
            'text_appeal' => Yii::t('app', 'Сообщение'),
            'telefon' => Yii::t('app', 'Тел.'),
            'captcha' => Yii::t('app', 'Проверочный код'),
        ];
    }
}
