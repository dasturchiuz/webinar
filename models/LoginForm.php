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
class LoginForm extends Model
{
<<<<<<< HEAD
    public $login;
=======
    public $username;
>>>>>>> origin/master
    public $password;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
<<<<<<< HEAD
            // login and password are both required
            [['login'], 'required', 'message' => 'Login maydoni to`ldirilmadi'],
            [['password'], 'required', 'message' => 'Parol maydoni to`ldirilmadi'],

=======
            // username and password are both required
            [['username', 'password'], 'required'],
>>>>>>> origin/master
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

<<<<<<< HEAD
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Login yoki parol xato.');
            }
=======
            if (empty($user->password_hash)) {
                $this->addError($attribute, 'Кажется, вы не подтвердили свой адрес электронной почты или обратитесь к  администратору для полной активации');

                return;
            }

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Неверное имя пользователя или пароль.');
                return;
            }

            if (!$user->uActive()) {
                $this->addError($attribute, 'Вы пака не активированы. Обратитесь к администратору сайта для полной активации. ');
                return;
            }

>>>>>>> origin/master
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
<<<<<<< HEAD
            $this->_user = User::findByLogin($this->login);
=======
            $this->_user = User::findByUsername($this->username);
>>>>>>> origin/master
        }

        return $this->_user;
    }
}
