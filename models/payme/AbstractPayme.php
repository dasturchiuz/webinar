<?php
namespace app\models\payme;

use app\models\payme\PaymeRequest;
use app\models\payme\PaymeResponse;

abstract  class AbstractPayme{


    //kelgan so'rovni qabul qilish
    protected $request;

    //javobni olish va qaytarish
    protected $response;

    //transaction provider
    protected $provider;
    //xatolik
    protected $error;
    //accountsni saqlash
    protected $accounts=[];


    //inistalizatsiya qilamiz
    public function __construct($request, TransactionProvider $provider)
    {
        $this->provider=$provider;
        $this->request=new PaymeRequest($request);
        $this->response=new PaymeResponse($this->request);
    }


    //javob qaytaramiz

    public function response(){
        $this->validate();

        if($this->error){
            $result=$this->response->error($this->error, $this->request->errorMessage, $this->request->errorData);
        }else{
            $result=$this->{$this->request->method}();
        }

        return $result;
    }


    //transazkisya qilish mumkin yoki mumkinmasligini tekshiradi
    abstract protected function checkPerformTransaction();


    //tranzaksiya yaratamiz
    abstract protected function createTransaction();


    //tranzaksiyani utkazish hisobiga
    abstract protected function performTransaction();



    //tranzaksiyani qaytarish agar bizning billing tizimimizda foydalanuvchi hisobi bilan bog'langan b'lsa uni hisobidan pulni yechish

    abstract protected function cancelTransaction();


    //tranzaksiyamizning statusni teshirib ko'ramiz
    abstract protected function CheckTransaction();

    // paka ya ne realizuyim
    abstract protected function getStatement();


    //parolni uzgartirish uchun

    abstract protected function changePassword();


    //tekshirib ko'ramiz rquestni va requetsda method bormi yuqmi
    private function validate(){
        if(!$this->request->isValid()){
            $this->error=$this->request->error;
        }elseif(!method_exists($this, $this->request->method)){
            $this->error=PaymeResponse::METHOD_NOT_FOUND;
        }
    }


    //mikrotimeni olish
    protected function microtime(){
        return (time() * 1000);
    }




}