<?php
namespace app\components\bootstrapunset;

class Bootunset extends \dosamigos\multiselect\MultiSelectAsset{

    public function bootunset(){
        unset($this->depends);
    }
    public function run(){
        $this->depends=null;
    }
}

?>