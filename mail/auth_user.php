<?php
use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\BaseMessage instance of newly created mail message */

?>
    <h2>Здравствуйте <b><?=$familiya." ".$ism;?>!!!</b> </h2>
    <p><strong>Ваш id: </strong><?=$user_name;?> </p>
    <p>Спасибо за регистрацию на Alior.Uz.</p>
    Теперь вы можете войти на <?= Html::a('Alior.UZ', Url::home('http')."account/confirm-client?login=".$user_name."&auth_key=".$auth_key) ?> и активировать свой статус. После чего обратитесь к администратору сайта для полной активации.
