<?php
namespace app\models\payme;

use Yii;
use app\models\payme\AbstractPayme;
/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class Payme extends AbstractPayme
{

    protected $accounts=["order_id", "account_id"];


    protected $miniSum=100;


    protected $maxSum=1000000;

    protected $timeout=6000*1000;


    protected  $canCancelSuccessTransaction=false;


    protected $order_id="order_id";
    protected $account_id="account_id";
    protected $created_id="created_id";


    private $config=[
        'merchant'=>'5b483d432070767c46948e9d',
        'login'=>'Paycom',
        'key'=>'XYrN%cK4gV%Cyr1DbOd?6vfsmkKTS#gQZKAY',
        'test_key'=>'6tHK9yy22W#Iwq63nPkortJ202Tc@FZxqQmj'
    ];

    public function __construct($request)
    {
        file_put_contents('./log.txt', $request);
        parent::__construct($request, new DbTransaction());


    }

    public function checkPerformTransaction(){
        if(!$this->auth()){
            \Yii::error("Betta", 'xatoliklar');
           return  $this->response->error(PaymeResponse::AUTH_ERROR);
        }

        if(!$this->request->hasAccount($this->accounts) || !$this->request->hasParam(["amount"])){
            return $this->response->error(PaymeResponse::JSON_RPC_ERROR);
            \Yii::error("55 xxxxxxxxxxxxxxx", 'xatoliklar');
        }

        return $this->response->successCheckPerformTransaction();
    }

    //transactsiya yaratish
    public function createTransaction(){
        if(!$this->auth()){
            return  $this->response->error(PaymeResponse::AUTH_ERROR);
        }

        if(!$this->request->hasAccount($this->accounts) || !$this->request->hasParam(["amount", "time", "id"])){
            \Yii::error("68 xxxxxxxxxxxxxxx", 'xatoliklar');
            return $this->response->error(PaymeResponse::JSON_RPC_ERROR);

        }

        $accounts=$this->request->getParam("account");
        $amount=$this->getAmount($this->request->getParam("amount"));
        $transid=$this->request->getParam("id");
        $time=$this->request->getParam("time");

        //transactionni olish

        $trans=$this->provider->getByTransId($transid);

        if($trans){
            if($trans->state!=1)
            {
                return $this->response->error(PaymeResponse::CANT_PERFORM_TRANS);
            }

            if(!$this->checkTimeout($trans->create_time)){
                $this->provider->update($transid, [
                    "state" => -1,
                    "reason" => 4
                ]);

                return $this->response->error(PaymeResponse::CANT_PERFORM_TRANS, [
                    "uz" => "Vaqt tugashi o'tdi",
                    "ru" => "Тайм-аут прошел",
                    "en" => "Timeout passed"
                ]);


            }

            return $this->response->successCreateTransaction(
                $trans->create_time,
                $trans->id,
                $trans->state
            );

        }

        /* // check perform transaction
        // check order
        $invoice = $this->getInvoice($accounts[$this->userKey]);
        if (!$invoice) {
            return $this->response->error(PaymeResponse::USER_NOT_FOUND);
        }
        // Check amount
        if (!$this->isValidAmount($invoice['invoice_pay'], $amount)) {
            return $this->response->error(PaymeResponse::WRONG_AMOUNT);
        }
        // check order status
        $trans = $this->provider->getByOwnerId($accounts[$this->userKey]);
        if ($trans && $trans['state'] == 1) {
            return $this->response->error(PaymeResponse::PENDING_PAYMENT);
        }*/

        // Add new transaction
        try {
            $crid=\app\models\User::find()->where(['username'=>$accounts[$this->created_id]])->one();
            $this->provider->insert([
                'transaction' => $transid,
                'payme_time' => $time,
                'amount' => $amount,
                'state' => 1,
                'created_by' => $crid->id,
                'create_time' => $this->microtime(),
                'owner_id' => $accounts[$this->account_id],
                'order_id' => $accounts[$this->order_id],
            ]);
            $trans = $this->provider->getByTransId($transid);
            return $this->response->successCreateTransaction($trans->create_time, $trans->id, $trans->state);
        } catch (\Exception $e) {
            \Yii::error($e, 'xatoliklar');
            return $this->response->error(PaymeResponse::SYSTEM_ERROR);
        }
    }


    //Tranzaksiyani utkazish

    protected function performTransaction(){
        // check auth
        if (!$this->auth()) {
            return $this->response->error(PaymeResponse::AUTH_ERROR);
        }
        // Check fields
        if (!$this->request->hasParam(["id"])) {
            \Yii::error("68 xxxxxxxxxxxxxxx", 'xatoliklar');
            return $this->response->error(PaymeResponse::JSON_RPC_ERROR);

        }
        // Search by id
        $transId = $this->request->getParam('id');
        $trans = $this->provider->getByTransId($transId);
        if (!$trans) {
            return $this->response->error(PaymeResponse::TRANS_NOT_FOUND);
        }
        if ($trans->state != 1) {
            if ($trans->state == 2) {
                return $this->response->successPerformTransaction($trans->state, $trans->perform_time, $trans->id);
            } else {
                return $this->response->error(PaymeResponse::CANT_PERFORM_TRANS);
            }
        }
        // Check timeout
        if (!$this->checkTimeout($trans->create_time)) {
            $this->provider->update($transId, [
                "state" => -1,
                "reason" => 4
            ]);
            return $this->response->error(PaymeResponse::CANT_PERFORM_TRANS, [
                "uz" => "Vaqt tugashi o'tdi",
                "ru" => "Тайм-аут прошел",
                "en" => "Timeout passed"
            ]);
        }
        //balans tuldirildi
        try {
            if(!$this->payOrder($trans))
            {
                \Yii::error("191 xxxxxxxxxxxxxxx", 'xatoliklar');

                return $this->response->error(PaymeResponse::CANT_PERFORM_TRANS);
            }
            $performTime = $this->microtime();
            $this->provider->update($transId, [
                "state" => 2,
                "perform_time" => $performTime
            ]);
            return $this->response->successPerformTransaction(2, $performTime, $trans->id);
        } catch (\Exception $e) {
            \Yii::error($e, 'xatoliklar');

            return $this->response->error(PaymeResponse::CANT_PERFORM_TRANS);
        }
    }
    //invoice ga yozish
    protected function payOrder($trans)
    {

        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
        try {
            $order = \app\models\Orders::findOne($trans->order_id);
            if (empty($order)) {
                return false;
            }

            $invoice = new \app\models\Invoices();
            $invoice->order_id = $trans->order_id;
            $invoice->in_date = date("Y-m-d H:i:s");
            $invoice->in_desc ="Opalata cherez payme";
            $invoice->pay_id = 6;
            $invoice->amount = $trans->amount;
            $invoice->transaction_id = $trans->id;
            $invoice->status = 1;
            $invoice->created_by=$trans->created_by ;
            $invoice->save(false);



            if ($order->sum == $trans->amount && $order->delivery_status == \app\models\Orders::STATUS_NODELEVER) {
                $order->status = \app\models\Orders::STATUS_OPLACHEN_NO_DASTAVLEN;
                $order->save(false);
            }

            $transaction->commit();
            return true;
        }catch(Exception $e){
            $transaction->rollback();
            \Yii::error($e, 'xatoliklar');

        }

        return false;

    }

    //invoice ga yozish
    protected function cancelPay($trans)
    {

        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
        try {
            $order = \app\models\Orders::findOne($trans->order_id);
            if (empty($order)) {
                return false;
            }

            $invoice = \app\models\Invoices::find()->where(['transaction_id'=>$trans->id])->one();

            $invoice->status = -1;
            $invoice->in_desc = "Платеж отменен: ".date("Y-m-d H:i:s");

            $invoice->save(false);



            $transaction->commit();
            return true;
        }catch(Exception $e){
            $transaction->rollback();
            \Yii::error($e, 'xatoliklar');

        }

        return false;

    }

    //transaction status check

    protected function CheckTransaction(){
        // check auth
        if (!$this->auth()) {
            return $this->response->error(PaymeResponse::AUTH_ERROR);
        }
        // Check fields
        if (!$this->request->hasParam(["id"])) {
            \Yii::error("68 xxxxxxxxxxxxxxx", 'xatoliklar');
            return $this->response->error(PaymeResponse::JSON_RPC_ERROR);
        }
        $transId = $this->request->getParam("id");
        $trans = $this->provider->getByTransId($transId);
        if ($trans) {
            return $this->response->successCheckTransaction(
                $trans->create_time,
                $trans->perform_time,
                $trans->cancel_time,
                $trans->id,
                $trans->state,
                $trans->reason
            );
        } else {
            \Yii::error("219 xxxxxxxxxxxxxxx", 'xatoliklar');
            return $this->response->error(PaymeResponse::TRANS_NOT_FOUND);
        }
    }


    //Transaksiyani qaytarish
    protected function cancelTransaction()
    {
        // check auth
        if (!$this->auth()) {
            return $this->response->error(PaymeResponse::AUTH_ERROR);
        }
        // Check fields
        if (!$this->request->hasParam(["id", "reason"])) {
            return $this->response->error(PaymeResponse::JSON_RPC_ERROR);
        }
        $transId = $this->request->getParam("id");
        $reason = $this->request->getParam("reason");
        $trans = $this->provider->getByTransId($transId);
        if (!$trans) {
            $this->response->error(PaymeResponse::TRANS_NOT_FOUND);
        }
        if ($trans->state == 1) {
            $cancelTime = $this->microtime();
            $this->provider->update($transId, [
                "state" => -1,
                "cancel_time" => $cancelTime,
                "reason" => $reason
            ]);
            return $this->response->successCancelTransaction(-1, $cancelTime, $trans->id);
        }
        if ($trans->state != 2) {
            return $this->response->successCancelTransaction($trans->state, $trans->cancel_time, $trans->id);
        }
        try {
            //$this->withdrawBalance($trans['owner_id'], $trans['amount']);
            $this->cancelPay($trans);
            $cancelTime = $this->microtime();
            $this->provider->update($transId, [
                "state" => -2,
                "cancel_time" => $cancelTime,
                "reason" => $reason
            ]);
            return $this->response->successCancelTransaction(-2, $cancelTime, $trans->id);
        } catch (\Exception $e) {
            return $this->response->error(PaymeResponse::CANT_CANCEL_TRANSACTION);
        }
    }


    private function getAmount($amount) {
        return $amount / 100;
    }
    /**
     * Transaksiyani tekshiradi timeoutga qarab
     *
     * @param $created_time
     * @return bool
     */
    private function checkTimeout($created_time)
    {
        return $this->microtime() <= ($created_time + $this->timeout);
    }

    /**
     * Hozircha bu metod hech narsa qilmaydi, lekin keyin albatta qilaman
     */
    public function getStatement()
    {
        // TODO: Implement GetStatement() method.
    }
    /**
     * Bu metod parolni uzgartirish uchun kk
     */
    protected function changePassword()
    {
        // TODO: Implement ChangePassword() method.
    }

    //avtorizatsiya qilib olamiz
    //getallheadersdan headerni olamiz
    //1 shart headerni tekshiramiz
    //2 headerda avtorization bor yuqligini tekshiramiz
    //3 basic autorizationni olamiz
    //4 basic autorizatini login va test key
    /**
     * @return bool
     *
     */


    public function auth()
    {
        $headers = getallheaders();
        if (!$headers ||
            !isset($headers['Authorization']) ||
            !preg_match('/^\s*Basic\s+(\S+)\s*$/i', $headers['Authorization'], $matches) ||
            base64_decode($matches[1]) != $this->config['login'] . ":" . $this->config['key']
        ) {
            return false;
        }
        return true;
    }

}
