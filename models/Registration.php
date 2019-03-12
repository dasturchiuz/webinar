<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class Registration extends Model
{
    public $firstname;
    public $lastname;
    public $fathername;
    public $tell;
    public $region_id;
    public $adress;
    public $email;
    public $password;
    public $password_conf;
    public $tashkilot;
    public $bank;
    public $hisobraqam;
    public $oked;
    public $inn;
    public $mfo;
    public $is_juridical;

    /**
     * @return array the validation rules.
     */
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

    public function checkLogin($attribute, $params)
    {
        $connection = \Yii::$app->db;
        $model = $connection->createCommand("SELECT COUNT(*) FROM user WHERE username = '".$this->username."'; '");

        $users_count = $model->queryScalar();
        if($users_count!=0)
        {
            $this->addError($attribute, 'Login mavjud');
        }
    }

    public function checkEmail($attribute, $params)
    {
        $connection = \Yii::$app->db;
        $model = $connection->createCommand("SELECT COUNT(*) FROM user WHERE username = '".$this->email." '; '");

        $users_count = $model->queryScalar();
        if($users_count!=0)
        {
            $this->addError($attribute, 'Этот E-Mail уже используется');
        }
    }


    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    public function checkPass($attribute, $params)
    {
        if($this->password!=$this->password_conf)
            $this->addError($attribute, "Parolni tekshiring!");
    }


}
