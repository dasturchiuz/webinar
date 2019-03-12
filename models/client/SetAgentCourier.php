<?php
namespace app\models\client;
use Yii;
use yii\base\Model;

class SetAgentCourier extends Model {
    public $id;
    public $week_number_agent;
    public $week_number_courier;
    public $client_id;
    public $user_id_agent;
    public $user_id_courier;
    
    public function rules()
    {
        return [
            // username and password are both required
            [['firstname', 'lastname', 'fathername', 'tell', 'adress', 'email', 'password', 'password_conf', 'is_juridical', 'region_id'], 'required'],
            [['hisobraqam', 'inn', 'mfo', 'is_juridical','oked'], 'integer'],
            [['tashkilot', 'bank', 'hisobraqam', 'oked', 'inn', 'mfo'], 'required', 'when' =>function($model){return $model->is_juridical==1;}, 'enableClientValidation' => false],
            ['email', 'checkEmail'],
            ['password_conf','checkPass'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'firstname' => Yii::t('app', 'Имя'),
            'lastname' => Yii::t('app', 'Фамилия'),
            'fathername' => Yii::t('app', 'Отчество'),
            'tell' => Yii::t('app', 'Телефон'),
            'adress' => Yii::t('app', 'Адрес'),
            'is_juridical' => Yii::t('app', 'Ваш статус'),
            'status' => Yii::t('app', 'Status'),
            'region_id' => Yii::t('app', 'Область'),
            'email' => Yii::t('app', 'Эл. адрес'),
            'password_conf' => Yii::t('app', 'Повтор пароля'),
            'password' => Yii::t('app', 'Пароль'),
            'tashkilot' => Yii::t('app', 'Организация'),
            'bank' => Yii::t('app', 'Наименование банка'),
            'hisobraqam' => Yii::t('app', 'Расчётный счёт'),
            'inn' => Yii::t('app', 'ИНН'),
            'mfo' => Yii::t('app', 'МФО'),
            'isjuridic' => Yii::t('app', 'Ваш статус'),
            'oked' => Yii::t('app', 'ОКЭД'),
        ];
    }


}