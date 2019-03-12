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
class Activation extends Model
{
    const ONE_STEP="ONE_STEP";
    const TWO_STEP="TWO_STEP";
    public $username;
    public $telefon;
    public $auth_key;
    public $main_name;
    public $pswd;
    public $pswd_confirm;
    public $login;

    public function scenarios(){
        $scenarios = parent::scenarios();
        $scenarios[self::ONE_STEP]=['username', 'telefon', 'auth_key'];
        $scenarios[self::TWO_STEP]=[ 'main_name','login', 'pswd', 'pswd_confirm'];
        return $scenarios;
    }


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'telefon', 'auth_key'], 'required', 'on'=> self::ONE_STEP ],
            ['main_name', 'match',  'pattern' => '/^[a-zA-Z0-9_-]+$/', 'message' => 'Ваше имя пользователя может содержать только буквенно-цифровые символы, символы подчеркивания и тире'],
            ['login', 'match',  'pattern' => '/^[a-zA-Z0-9_-]+$/', 'message' => 'Ваше имя пользователя может содержать только буквенно-цифровые символы, символы подчеркивания и тире'],
            [['user_id', 'login', 'telefon', 'auth_key', 'main_name', 'pswd', 'pswd_confirm'], 'required', 'on'=> self::TWO_STEP ],
            // password is validated by validatePassword()
            ['pswd_confirm', 'checkPass'],
            ['main_name', 'checkMain'],
            ['login', 'checkLogin'],

        ];
    }
    public function attributeLabels()
    {
        return [
            'telefon' => Yii::t('app', '*Номер телефона'),
            'main_name' => Yii::t('app', '*Выберите имя пользователя'),
            'pswd' => Yii::t('app', '*Выберите пароль'),
            'pswd_confirm' => Yii::t('app', '*Подтвердите пароль '),
            'login' => Yii::t('app', '*Логин '),

        ];
    }
    public function checkPass($attribute, $params)
    {
        if($this->pswd_confirm!=$this->pswd)
            $this->addError($attribute, "Пароли не совпадают");
    }

    public function checkMain($attribute, $params)
    {
        $connection = \Yii::$app->db;
        $model = $connection->createCommand("SELECT COUNT(*) FROM profile WHERE name_magazin = '".$this->main_name."'; '");

        $users_count = $model->queryScalar();
        if($users_count!=0)
        {
            $this->addError($attribute, $this->main_name.' имя пользователя уже используется');
        }
    }
    //loginnitekshirish
    public function checkLogin($attribute, $params)
    {
        $connection = \Yii::$app->db;
        $model = $connection->createCommand("SELECT COUNT(*) FROM user WHERE username = '".$this->login."'; '");

        $users_count = $model->queryScalar();
        if($users_count!=0)
        {
            $this->addError($attribute, $this->main_name.' Логин уже используется');
        }
    }


}
