<?php
use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\BaseMessage instance of newly created mail message */

?>
<h2>Здравствуйте <b>Admin</b>, У вас есть сообщение от клиент </h2>
<p><strong>Имя: </strong><?=$client_name;?> </p>
<p><strong>Эл. адрес: </strong><?=$email;?> </p>
<p><strong>Тел.: </strong><?=$telefon;?> </p>
<p><strong>Тема: </strong><?=$theme_appeal;?> </p>
<p><strong>Сообщение: </strong><?=$text_appeal;?> </p>
<p>Этот сообшения отпрален на Alior.Uz.</p>


