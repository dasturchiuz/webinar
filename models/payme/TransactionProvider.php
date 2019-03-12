<?php
namespace app\models\payme;



interface TransactionProvider{
    //tranzaksiyani id si buyicha olish
    public function getByTransId($transId);


    //foydalanuvchi buyicha olish
    /**
     * @param $ownerId
     * @return mixed
     */
    public function getByOwenerId($ownerId);

    /**
     * @param $trasnId
     * @param array $fields
     * @return mixed
     */
    public function update($trasnId, array $fields);

    /**
     * @param array $fields
     * @return mixed
     */
    public function insert(array $fields);
}
