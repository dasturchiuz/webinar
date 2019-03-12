<?php
namespace app\models\checkout;

use Yii;
use app\models\Debitor;
use app\models\User;
use app\models\CommentProfile;
use app\models\Invoices;
use app\models\Orders;

class PayActions {

    protected $order;

    public function __construct(Orders $order_)
    {
        $this->order=$order_;
    }

    protected function praverkaPayStatus(){
        $invoice=Invoices::find()->where(['order_id'=>$this->order->id, 'status'=>1])->sum('amount');
        return $this->order->sum==$invoice ? true : false;

    }

    //1. Oplata pri dastavki
    public function Tolov($pay_sum, $payMethod){
        if($this->praverkaPayStatus()){
            return false;
        }
        $invoice= new Invoices();
        $invoice->order_id=$this->order->id;
        $invoice->in_date=date("Y-m-d H:i:s");
        $invoice->in_desc="Оплачено ".Yii::$app->user->identity->username;
        $invoice->pay_id=$payMethod;
        $invoice->amount=$pay_sum;
        $invoice->status=1;
        if(!$invoice->save(false)){
            return false;
        }
        return true;
    }
    //2. Vdolg


    //3. qarzni to'lash
    //agar oplata pri dastavkada qarz mavjud bo'lsa va uni payme orqali qaytarayotgan bo'lsa  u yerda tekshirsin
    /*
     * 1. zakaz id ni va userprofileni topsin-*
     * 2. debitordan izlasin STATUS NEW izlasin-*
     * 3. agar bo'lmasa false -*
     * 4. agar bo'lsa joriy qarzni STATUS OFFGA o'tkazsin
     * 5. Invoice ga summani to'lasin
     * 6. Joriy qarzdan to'langan summani ayrib yangi qarzga yozsin
     * * Agar joriy to'lov joriy qarzga teng bo'lsa yangi debit yaratmasin
     * 7. DEFAULT qilib vernut dolg datega hozirgi vaqtni yozsin
     * 8. Agar to'lov joriy qarz summadan yuqori bo'lsa otkaz bersin
     * */
    public function PayDebit($amount_sum, $payMethod){
        if(!($debit=$this->DebitStatus($this->order->user_id, $this->order->id))){
            return false;
        }
        $conn=Yii::$app->db;
        $transaction=$conn->beginTransaction();
        try{
            //kiruvchi summani invocce ga yozamiz
            $invoice= new Invoices();
            $invoice->order_id=$this->order->id;
            $invoice->in_date=date("Y-m-d H:i:s");
            $invoice->in_desc="Oplata by ".isset(Yii::$app->user->identity->username) ? Yii::$app->user->identity->username : "Ne kto neznayu"  ;
            $invoice->pay_id=$payMethod;
            $invoice->amount=$amount_sum;
            $invoice->status=1;
            if(!$invoice->save(false)){
                $transaction->rollback();
                return false;
            }

            $debit->status=Debitor::STATUS_OFF;
            if(!$debit->save(false)){
                $transaction->rollback();
                return false;
            }
            if($debit->amount > $invoice->amount)
            {
                $Debitor=new Debitor();
                $Debitor->order_id= $this->order->id;
                $Debitor->amount=$debit->amount-$invoice->amount;
                $Debitor->profile_id= $this->order->user_id;
                $Debitor->repay_date=date('Y-m-d');
                if(!$Debitor->save(false)){
                    $transaction->rollback();
                    return false;
                }
            }
            $transaction->commit();
            return true;
        }catch(\Exception $e){
            $transaction->rollback();
            return false;
        }
    }

    //qarzdor yoki qarzdor emasligini tekshirish uchun agar qarzdor bolsa debitor obektini qaytaradi
    /**
     * @param $profile_id
     * @param $order_id
     * @return bool
     */
    protected function DebitStatus($profile_id, $order_id){
        $debitor=Debitor::find()->where(['profile_id'=>$profile_id,'order_id'=>$order_id,'status'=>Debitor::STATUS_NEW,])->one();
        if(empty($debitor)){
            return false;
        }
        return $debitor;
    }

    //end qarz

    //4. orderga status berish
    public function SetOrderStatus($status, $delivery_status){
        $this->order->status=$status;
        $this->order->delivery_status=$delivery_status;
        $this->order->delivered_date=date('Y-m-d H:i:s');
        if(!$this->order->save(false)){
            return false;
        }
        return true;
    }

    //5. qarzga olish
    public  function Qarzga($pay_sum, $debit_sum,  $debit_date, $comm_text){
        $Debitor=new Debitor();
        $Debitor->order_id= $this->order->id;
        $Debitor->amount=$debit_sum;
        $Debitor->profile_id= $this->order->user_id;
        $Debitor->repay_date=$debit_date;
        if(!$Debitor->save(false) && $this->Kommentariya(
                $pay_sum,
                $debit_sum,
                $comm_text
                )){
            return false;
        }
        return true;
    }

    //6. set comment
    protected function Kommentariya($pay_sum, $debit_sum, $comment_text){
        $comment=new CommentProfile();
        $comment->profile_id=$this->order->user_id;
        $comment->com_text='Офоримть доставка №'.$this->order->id." Наличи: ".$pay_sum." в долг: ".$debit_sum."<br>".$comment_text;
        if(!$comment->save(false)){
            return false;
        }
        return true;
    }

}