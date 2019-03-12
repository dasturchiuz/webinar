<?php

namespace app\modules\administration\models;

use Yii;

/**
 * This is the model class for table "employees".
 *
 * @property int $id
 * @property string $surname
 * @property string $firstname
 * @property string $fathername
 * @property int $role
 * @property string $adress
 * @property string $tell
 * @property int $created_at
 * @property int $updated_at
 * @property int $user_id
 * @property string $last_activity_time
 */
class Employees extends \yii\db\ActiveRecord
{
    public $username;
    public $password;
    public $password_conf;
    public $email;
    public $fullname;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_employees';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['surname', 'firstname', 'fathername','fullname', 'role', 'adress', 'email', 'tell', 'created_at','username', 'password', 'password_conf', 'updated_at', 'user_id', 'last_activity_time'], 'required'],
            [[ 'created_at', 'updated_at', 'user_id'], 'integer'],
            [['last_activity_time'], 'safe'],
            [['role','surname', 'firstname', 'fathername', 'tell'], 'string', 'max' => 20],
            [['adress'], 'string', 'max' => 250],
            [['user_id'], 'unique'],
            ['username', 'checkLogin'],
            ['email', 'checkEmail'],
            ['password_conf','checkPass'],
        ];
    }



    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'surname' => 'Фамилия',
            'firstname' => 'Имя',
            'fathername' => 'Отчество',
            'role' => 'Тип пользователя',
            'adress' => 'Адрес',
            'tell' => 'Телефон',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_id' => 'User ID',
            'fullname' => 'Ф.И.О',
            'last_activity_time' => 'Last Activity Time',
        ];
    }

    public function checkLogin($attribute, $params)
    {
        $connection = \Yii::$app->db;
        $model = $connection->createCommand("SELECT COUNT(*) FROM tbl_user WHERE username = '".$this->username."'; '");

        $users_count = $model->queryScalar();
        if($users_count!=0)
        {
            $this->addError($attribute, 'Login mavjud');
        }
    }
    public function checkEmail($attribute, $params)
    {
        $connection = \Yii::$app->db;
        $model = $connection->createCommand("SELECT COUNT(*) FROM tbl_user WHERE email = '".$this->email."'; '");

        $users_count = $model->queryScalar();
        if($users_count!=0)
        {
            $this->addError($attribute, 'Этот E-Mail уже используется');
        }
    }

    public function getFullnameemp()
    {
        return $this->surname." ".$this->firstname." ".$this->fathername;
    }

    public function getRolename()
    {
        $user_massiv= [
                'super_admin'=>'Супер администратор	',
                'admin'=>'Администратор',
                'manager'=>'Менеджеры',
                'regional_managers'=>'Региональные менеджеры',
                'super_admin'=>'Региональные менеджеры',
                'agent'=>'Агент',
                'сouriers'=>'Курьеры'
        ];
        return $user_massiv[$this->role];

    }

    public function checkPass($attribute, $params)
    {
        if($this->password!=$this->password_conf)
            $this->addError($attribute, "Parolni tekshiring!");
    }
}
