<?php
namespace app\models\checkout;

use Yii;
use app\models\Debitor;

class VernutDolg extends \yii\base\Model{
    public $order_id;
    public $debit_summ;
    public $method_pay;

    public function rules(){
        return [
            [['order_id', 'debit_summ', 'method_pay'], 'required'],
            ['debit_summ', 'checkSum']

        ];

    }

    public function attributeLabels(){
        return [
            'order_id',
            'debit_summ'=>'Видеть сумма долг',
            'method_pay'=>'Способ оплаты',
        ];
    }

    public function checkSum($attribute, $params){
        $debitor=Debitor::find()->where(['order_id'=>$this->order_id])->one();
        if(empty($debitor)){
            $this->addError($attribute, "Bunday zakaz mavjud emas");
        }
        if($debitor->amount<$this->debit_summ){
            $this->addError($attribute, "Вводимая сумма превышает сумму долга ".$debitor->amount." < ".$this->debit_summ);

        }
    }


}