<?php
namespace app\models\payme;

use app\models\payme\TransactionProvider;
use app\models\Paymeuz;
class DbTransaction implements TransactionProvider{

    public function getByTransId($transId){
        return Paymeuz::find()->where(['transaction'=>$transId])->one();
    }


    //foydalanuvchi buyicha olish
    /**
     * @param $ownerId
     * @return mixed
     */
    public function getByOwenerId($ownerId){
        return Paymeuz::find()->where(['owner_id'=>$ownerId])->all();
    }

    /**
     * @param $trasnId
     * @param array $fields
     * @return mixed
     */
    public function update($trasnId, array $fields){
        $payme=Paymeuz::find()->where(['transaction'=>$trasnId])->one();
        foreach($fields as $key => $value){
            $payme->{$key}=$value;
        }
        return $payme->save(false);
        //return false; //paka keyin o'ylayman
    }

    /**
     * @param array $fields
     * @return mixed
     */
    public function insert(array $fields){
        $payme=new Paymeuz();
        $payme->transaction=$fields['transaction'];
        $payme->payme_time=$fields['payme_time'];
        $payme->amount=$fields['amount'];
        $payme->state=$fields['state'];
        $payme->created_by=$fields['created_by'];
        $payme->create_time=$fields['create_time'];
        $payme->owner_id=$fields['owner_id'];
        $payme->order_id=$fields['order_id'];
        return $payme->save(false);
    }

}