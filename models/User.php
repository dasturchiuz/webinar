<?php

namespace app\models;

use Yii;
<<<<<<< HEAD
use yii\web\IdentityInterface;
use yii\swiftmailer\Message;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $name
 * @property string $fam
 * @property string $otec
 * @property string $birth_date
 * @property string $pol
 * @property int $tel
 * @property string $email
 * @property string $login
 * @property string $password
 * @property int $isAdmin
 * @property string $avatar
 * @property string $secret_key
 *
 * @property Comment[] $comments
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    const STATUS_ACTIVE = 0;

=======
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\behaviors\TimestampBehavior;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "tbl_user".
 *
 * @property string $id
 * @property string $username
 * @property string $password
 */
class User extends \yii\db\ActiveRecord  implements IdentityInterface
{
    const STATUS_NEW = 0;
    const STATUS_CHECKED = 10;
    const STATUS_BLOCKED = 20;
    const STATUS_DELETED = 30;
    public function behaviors(){
        return [
            [
                'class'=>TimestampBehavior::className(),
                'attributes'=>[
                    ActiveRecord::EVENT_BEFORE_INSERT=>['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE=>['updated_at'],
                ],
                'value'=>function(){ return date('U');},
            ],

        ];
    }
    public static function getStatuses()
    {
        return [
            self::STATUS_NEW => 'Неактивный',
            self::STATUS_CHECKED => 'Активный',
            self::STATUS_BLOCKED => 'Блокированный',
            self::STATUS_DELETED => 'Удаленный',
        ];
    }
>>>>>>> origin/master

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
<<<<<<< HEAD
        return 'user';
=======
        return '{{%user}}';
>>>>>>> origin/master
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
<<<<<<< HEAD
            [['birth_date'], 'safe'],
            [['isAdmin', 'tel'], 'integer'],
            [['name', 'fam', 'otec', 'pol', 'email', 'login', 'password', 'avatar'], 'string', 'max' => 255],
            ['secret_key', 'unique']
=======
            [['username', 'user_id', 'auth_key', 'password_hash', 'email','telefon', 'created_at', 'updated_at'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'telefon', 'user_id'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
>>>>>>> origin/master
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
<<<<<<< HEAD
            'id' => 'ID',
            'name' => 'Name',
            'fam' => 'Fam',
            'otec' => 'Otec',
            'birth_date' => 'Birth Date',
            'pol' => 'Pol',
            'tel' => 'Tel',
            'email' => 'Email',
            'login' => 'Login',
            'password' => 'Password',
            'isAdmin' => 'Is Admin',
            'avatar' => 'Avatar',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['user_id' => 'id']);
    }

    public static function findIdentity($id)
    {
        return User::findOne($id);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }

    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }

    public static function findByLogin($login)
    {
        return User::find()->where(['login' => $login])->one();
    }


    public static function findBySecretKey($key)
    {
        if(!static::isSecretKeyExpire($key))
        {
            return null;
        return static::findOne(
            [
                'secret_key' => $key
            ]
        );
        }
    }

    public function generateSecretKey()
    {
        $this->secret_key = Yii::$app->security->generateRandomString().'_'.time();
    }

    public function removeSecretKey()
    {
        $this->secret_key = null;
    }

    public static function isSecretKeyExpire($key)
    {
        if(empty($key))
        {
            return false;
        $expire = Yii::$app->params['secretKeyExpire'];
        $parts = explode('_', $key);
        $timestamp = (int) end($parts);
        return $timestamp + $expire >= time();
        }
    }


    public function validatePassword($password)
    {
        return ($this->password == $password) ? true : false;
    }

    public function create()
    {
        return $this->save(false);
    }
=======
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'user_id'),
            'username' => Yii::t('app', 'Username'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'email' => Yii::t('app', 'Email'),
            'telefon' => Yii::t('app', 'Телефон'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfiles()
    {
        return $this->hasMany(Profile::className(), ['user_id' => 'id']);
    }
    /** INCLUDE USER LOGIN VALIDATION FUNCTIONS**/
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    /* modified */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /* removed
        public static function findIdentityByAccessToken($token)
        {
            throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
        }
    */
    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * Finds user by password reset token
     *
     * @param  string      $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        $expire = \Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        if ($timestamp + $expire < time()) {
            // token expired
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token
        ]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }
    public function getProfile(){
        return $this->hasOne(Profile::className(), ['user_id' => 'id']);
    }

    public function getRegionId(){
        return  $this->profile->region_id;
    }
    public function getNameMagazin(){
        return  $this->profile->name_magazin!=null ? $this->profile->name_magazin : false;
    }
    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }




    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
//        if(Yii::$app->getSecurity()->generatePasswordHash($password)==$this->password_hash)
//            return true;
//        else
//            return false;
        
        return Yii::$app->getSecurity()->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        //$this->password = md5($password);
        $this->password_hash = Yii::$app->getSecurity()->generatePasswordHash($password);
    }

    public function uActive(){
        return $this->status==self::STATUS_CHECKED ? true : false;
    }
    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->getSecurity()->generateRandomKey();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->getSecurity()->generateRandomKey() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
    /** EXTENSION MOVIE **/
    public static function isSuperadmin(){
        if(Yii::$app->user->can('super_admin'))
            return true;
        else
            return false;
    }
     public static function isAdmin(){
        if(Yii::$app->user->can('admin'))
            return true;
        else
            return false;
    }
     public static function isRegman(){
        if(Yii::$app->user->can('regional_managers'))
            return true;
        else
            return false;
    }
     public static function isManager(){
        if(Yii::$app->user->can('manager'))
            return true;
        else
            return false;
    }
     public static function isAgent(){
        if(Yii::$app->user->can('agent'))
            return true;
        else
            return false;
    }
    public static function isCourier(){
        if(Yii::$app->user->can('сouriers'))
            return true;
        else
            return false;
    }public static function isBuxgalter(){
        if(Yii::$app->user->can('buxgalter'))
            return true;
        else
            return false;
    }


>>>>>>> origin/master
}
