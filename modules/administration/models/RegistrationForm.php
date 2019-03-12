<?php

namespace app\modules\administration\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use \yii\db\ActiveRecord;
use yii\base\Model;

/**
 * This is the model class for table "{{%profile}}".
 *
 * @property int $user_id
 * @property string $firstname
 * @property string $lastname
 * @property string $fathername
 * @property string $tell
 * @property string $role
 * @property string $adress
 * @property int $is_juridical
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $user
 */
class RegistrationForm extends Model
{

    public $orgonization;//*
    public $name_org;//*
    public $status_shop;//*
    public $name_magazin;
    public $familiya;
    public $ism;
    public $otasiningismi;
    public $telefon;//*
    public $email;//*
    public $strana;//*
    public $oblast;//*
    public $gorod;//*
    public $index;
    public $orenter;//*
    public $inn;
    public $mfo;
    public $oked;
    public $okpo;
    public $coato;
    public $bank;
    public $rasschyot;
    public $desc_comment;
    public $main_fio;
    public $ulitsa;
    public $dom;
    public $kvartera;
    public $brand_juridical;



    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                [
                    'inn',
                    'mfo',
                    'okpo',
                    'coato',
                    'oked',
                    'main_fio',
                    'rasschyot'

                ], 'safe'
            ],
            [
                [
                    'orgonization',
                    'name_org',
                    'status_shop',
                    'email',
                    'telefon',
                    'strana',
                    'oblast',
                    'familiya',
                    'ism',
                    'otasiningismi',
                    'gorod',
                    'orenter',
                ],
                'required'],
            [
                [
                    'orgonization',
                    'status_shop',
                    'strana',
                    'oblast',
                    'gorod',
                    'index',


                ],
                'integer'
            ],
            [
                [
                    'name_org',
                    'name_magazin',
                    'familiya',
                    'otasiningismi',
                    'bank',
                    'desc_comment',
                    'ulitsa',
                    'dom',
                    'kvartera',
                    'ism',
                    'telefon',
                    'orenter'
                ],
                'string',
            ],

           // [['rasschyot'], 'number', 'max'=>20],
            //[['user_id'], 'unique'],
            //[['user_id'], 'exist', 'skipOnError' => false, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            ['email', 'checkEmail'],
            ['telefon', 'checkTel'],
        ];
    }
    public function checkEmail($attribute, $params)
    {
        $connection = \Yii::$app->db;
        $model = $connection->createCommand("SELECT COUNT(*) FROM user WHERE email = '".$this->email."'; '");

        $users_count = $model->queryScalar();
        if($users_count!=0)
        {
            $this->addError($attribute, 'Электрон почта уже существует на сайте');
        }
    }
    public function checkTel($attribute, $params)
    {
        $connection = \Yii::$app->db;
        $model = $connection->createCommand("SELECT COUNT(*) FROM profile WHERE tell = '".$this->telefon."'; '");

        $users_count = $model->queryScalar();
        if($users_count!=0)
        {
            $this->addError($attribute, 'Электрон почта уже существует на сайте');
        }
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'orgonization' => Yii::t('app', '*Организация'),//juridicalga
            'name_org' => Yii::t('app', '*Название организации'),//juridicalga
            'status_shop' => Yii::t('app', '*Вид деятельности'),//juridicalga
            'name_magazin' => Yii::t('app', 'Доп. наз (имя пользователя)'),//profilga
            'brand_juridical' => Yii::t('app', 'Бренд'),//profilga
            'familiya' => Yii::t('app', 'Фамилия'),
            'ism' => Yii::t('app', 'Имя'),
            'otasiningismi' => Yii::t('app', 'Отчество'),
            'telefon' => Yii::t('app', '*Тел:'),
            'email' => Yii::t('app', '*E-mail:'),
            'strana' => Yii::t('app', '*Страна'),
            'oblast' => Yii::t('app', '*Область'),
            'gorod' => Yii::t('app', '*Город'),
            'index' => Yii::t('app', 'Индекс'),
            'orenter' => Yii::t('app', '*Ориентир'),
            'inn' => Yii::t('app', 'ИНН'),
            'mfo' => Yii::t('app', 'МФО'),
            'oked' => Yii::t('app', 'ОКЭД'),
            'okpo' => Yii::t('app', 'ОКПО'),
            'coato' => Yii::t('app', 'СОАТО'),
            'bank' => Yii::t('app', 'Название банка '),
            'rasschyot' => Yii::t('app', 'Р/С организации'),
            'desc_comment' => Yii::t('app', ' Примечание '),
            'main_fio' => Yii::t('app', 'Использовать для аторизации'),
            'ulitsa' => Yii::t('app', '*Улица (посёлок)'),
            'dom' => Yii::t('app', 'Дом'),
            'kvartera' => Yii::t('app', 'Квартира'),
            /*'ulitsa',
                    'dom',
                    'kvartera',*/
        ];
    }

}
