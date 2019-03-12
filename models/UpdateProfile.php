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
class UpdateProfile extends Model
{
    public $user_id;
    public $lastname;
    public $firstname;
    public $fathername;
    public $region_id;
    public $adress;
    public $tell;
    public $fullnameemp;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['user_id','lastname', 'firstname', 'fathername', 'region_id', 'adress', 'tell'], 'required'],

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
            'oblastid' => Yii::t('app', 'Область'),
            'fullnameemp' => Yii::t('app', 'fullnameemp'),
            'user_id' => Yii::t('app', 'user_id'),
        ];
    }


}
