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
class Oplata extends Model
{
    public $pay_sum;
    public $debit_sum;
    public $order_id;
    public $method_pay;
    public $order_summ;
    public $order_itog;
    public $comment_text;
    public $debit_date;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['pay_sum',  'order_id', 'order_summ', 'order_itog', 'method_pay',  ], 'required', 'message'=>$this->order_itog],
            [[ 'order_id', ], 'integer'],
            [['pay_sum', 'debit_sum', 'order_summ','order_itog'], 'double'],
            [['comment_text',], 'string'],
            [['debit_date',], 'date', 'format' => 'php:Y-m-d'],

            [
                ['debit_sum',], 'required', 'when' =>function($model){
                    $order=\app\models\Orders::findOne($this->order_id);
                    return $order->sum!=$model->pay_sum ? true : false;
                },
                'enableClientValidation' => false
            ],

            [
                ['comment_text', 'debit_date'], 'required', 'when' =>function($model){
                    $order=\app\models\Orders::findOne($this->order_id);
                    return $order->sum!=$model->pay_sum ? true : false;
                },
                'message'=>'Виберите дату венуть долг', 'enableClientValidation' => false
            ],
            [
                ['debit_date'], 'required', 'when' =>function($model){
                    $order=\app\models\Orders::findOne($this->order_id);
                    return $order->sum!=$model->pay_sum ? true : false;
                },
               'enableClientValidation' => false
            ],

            ['debit_sum', 'checkTenglik'],
            //['comment_text', 'commTenglik']

        ];
    }
    public function checkTenglik($attribute, $params)
    {
        
        if($this->order_itog!=($this->pay_sum+$this->debit_sum))
        {
            $this->addError($attribute, $this->order_itog-$this->pay_sum." сум осталось долг");
        }

        if($this->pay_sum==$this->debit_sum)
        {
            $this->addError($attribute, $this->debit_sum." сум тенг туланиладиган сумга");
        }
    }
    public function commTenglik($attribute, $params)
    {

    }
    public function attributeLabels()
    {
        return [
            'pay_sum' => Yii::t('app', 'Сумма вводит'),
            'debit_sum' => Yii::t('app', 'Остаток в долг'),
            'order_summ' => Yii::t('app', 'Общее заказ сум'),
            'order_id' => Yii::t('app', 'заказ ид'),
            'order_itog' => Yii::t('app', 'Адрес'),
            'debit_date' => Yii::t('app', 'Долг дата'),
            'method_pay' => Yii::t('app', 'Способ оплаты'),
            'comment_text' => Yii::t('app', 'Коментарии'),

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
