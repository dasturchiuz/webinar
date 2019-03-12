<?php

namespace app\models;

use Yii;
use yii\helpers\Security;
use yii\base\Model;
/**
 * This is the model class for table "admins".
 *
 * @property integer $id
 * @property string $name_dispetcher
 * @property string $adress
 * @property string $phone_work
 * @property integer $user_id
 * @property integer $status
 * @property string $usr_img
 */





class Passwordchange extends Model
{
    /**
     * @inheritdoc
     */
    const SCENARIO_PSWD='pswd';
    const SCENARIO_PSWD_USER='pswd_user';
    public $current_pswd;
    public $new_pswd;
    public $new_pswd_con;

    public function scenarios(){
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_PSWD]=['new_pswd_con', 'new_pswd'];
        $scenarios[self::SCENARIO_PSWD_USER]=['new_pswd_con', 'new_pswd', 'current_pswd'];
        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['new_pswd_con', 'new_pswd'], 'required', 'on'=> self::SCENARIO_PSWD],
            [['new_pswd_con', 'new_pswd', 'current_pswd'], 'required', 'on'=> self::SCENARIO_PSWD_USER],
            [[ 'current_pswd', 'new_pswd_con', 'new_pswd'], 'string'],
            ['current_pswd','checkPassword'],
            ['new_pswd_con','checkPass'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'current_pswd' => 'Текущий пароль',
            'new_pswd' => 'Новый пароль',
            'new_pswd_con'=>'Подтвердить новый пароль',

        ];
    }

    public function checkPassword($attribute, $params)
    {
        $user = User::find()->where([
            'username'=>Yii::$app->user->identity->username
        ])->one();

        if( !$user->validatePassword($this->current_pswd))
            $this->addError($attribute,'Ваш текущий пароль неверен');

    }

    public function checkPass($attribute, $params)
    {
        if($this->new_pswd!=$this->new_pswd_con)
            $this->addError($attribute, "Проверьте свой пароль! Причина появления нового пароля и пароля подтверждения не была равна");
    }

}
