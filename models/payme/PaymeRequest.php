<?php
namespace app\models\payme;
use Yii;



class PaymeRequest{
    /**
     * @var int $id
     */
    public $id; //Payme so'rovini idsi

    /**
     * @var string $method
     */
    public $method;//payme method

    /**
     * @var array $params
     */
    public $params;//parametrar

    /**
     * @var int $error
     */
    public $error; //payme error kodi
    /**
     * @var array $errorMessage
     */
    public $errorMessage; //error message
    /**
     * @var string $errorData
     */
    public $errorData; //error data


    public function __construct($request)
    {
        try{
            $data = json_decode($request, true);

            if($this->validateData($data)){
                $this->id=$data["id"];
                $this->method =$data["method"];
                $this->params =$data["params"];
            }else{
                $this->error = PaymeResponse::JSON_RPC_ERROR;
            }
        }catch(\Exception $e){
            $this->error = PaymeResponse::JSON_PARSING_ERROR;

        }
    }

    /**
     * Ushbu method params da rostan ham usha parametr bor yoki yuqligini tekshiradi
     * @param $param
     * @return bool
     */
    public function hasParam($param){
        if(is_array($param)){
            foreach($param as $item){
                if(!$this->hasParam($item)) return false;
            }
            return true;
        }else{
            return isset($this->params[$param]) && !empty($this->params[$param]);
        }
    }


    public function hasAccount(array $accounts){
        if(!$this->hasParam('account')){
            return false;
        }

        foreach($accounts as $account){
            if(!isset($this->params['account'][$account])){
                return false;
            }
        }
        return true;
    }

    /**
     * ushbu method parametrni bizga qaytaradi masalan amount
     * @param $param
     * @param null $default
     * @return null
     */
    public function getParam($param, $default=null){
        if($this->hasParam($param)){
            return $this->params[$param];
        }elseif($default){
            return $default;
        }
    }

    //mapymedan keladigan surovda id, params, method bor yoki yuqligini tekshirish
    protected function validateData(array $data){
        if(!isset($data["id"]) || empty($data["id"])){
            return false;
        }
        if(!isset($data["params"]) || empty($data["params"])){
            return false;
        }
        if(!isset($data["method"]) || empty($data["method"])){
            return false;
        }

        return true;
    }

    public function isValid(){
        return $this->error ? false : true ;
    }

}
