<?php
use yii\helpers\Html;
?>
<div class="card">
    <article class="card-body">
        <p class="title">Продавец:</p>
        <p><a href="<?='/shop/'.$profile->name_magazin;?>"> <i class="fas fa-user"></i> <strong><?=$profile->name_magazin?></strong></a></p>
        <p><i class="fas fa-map-marker-alt"></i> <?=$profile->oblast->name_obl?></p>
        <p><i class="fas fa-phone"></i> <?=$profile->tell?></p>
        <?= \dasturchiuz\chatroom\SendMessage::widget(['receiverID'=>$profile->user_id, 'txtclass'=>'text-info text-center', 'txt'=>'Отправить сообщение']); ?>
        <p class="text-center"><?=Html::a('<i class="fas fa-angle-down"></i> Покупаю', ['/shop/'.$profile->name_magazin.'/buy'], ['class'=>'text-primary'])?>  <?=Html::a('<i class="fas fa-angle-up"></i> Продаю', ['/shop/'.$profile->name_magazin."/sell"], ['class'=>'text-danger'])?></p>


    </article> <!-- card-body.// -->
</div>