<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<h4 class="title mb-4"><?=Html::a('Центр пользователя', ['account/index'])?> </h4>

<ul class="nav nav-pills flex-column text-left">

        <?php if(Yii::$app->user->identity->getNameMagazin()!=false):?>
            <li class="nav-item ">
                <a href="<?=Url::to(['shop/'.Yii::$app->user->identity->getNameMagazin()]);?>" class="nav-link <?=Yii::$app->controller->getRoute()=="shop/".Yii::$app->user->identity->getNameMagazin() ? "active" : "" ?>">Мой Магазин</a>
            </li>
        <?php endif;?>


    <li class="nav-item ">
        <a href="<?=Url::to(['my-shop/accepted-orders']);?>"  class="nav-link <?=Yii::$app->controller->getRoute()=="my-shop/accepted-orders" ? "active" : "" ?>"><?=Yii::t('app', 'Принятые заказы')?> <?php if(($o_count=\app\models\Orders::SellerNewOrdersCount(Yii::$app->user->identity->id, 0))):?><span class="badge badge-danger"><?=$o_count;?></span><?php endif;?> <?php if(($o_count=\app\models\Orders::SellerNewOrdersNotCount(Yii::$app->user->identity->id, 1))):?><span class="badge badge-info"><?=$o_count;?></span><?php endif;?></a>
    </li>
    <li class="nav-item ">
        <a href="<?=Url::to(['my-shop/orders']);?>"  class="nav-link <?=Yii::$app->controller->getRoute()=="my-shop/orders" ? "active" : "" ?>"><?=Yii::t('app', 'Мои заказы')?></a>
    </li>

    <li class="nav-item ">
        <a href="#"  class="nav-link "><strong>Товары</strong></a>
        <ul class="nav flex-column ml-3 text-left">
            <li class="nav-item">
                <a class="nav-link <?=Yii::$app->controller->getRoute()=="my-shop/my-products" ? "active" : "" ?>" href="<?=Url::to(['my-shop/my-products']);?>"><?=Yii::t('app', 'Мои товары')?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?=Yii::$app->controller->getRoute()=="my-shop/add-product" ? "active" : "" ?>" href="<?=Url::to(['my-shop/add-product']);?>"><?=Yii::t('app', 'Добавить товар')?></a>
            </li>

        </ul>
    </li>
    <li class="nav-item ">
        <a href="#"  class="nav-link "><strong>Архив</strong></a>
        <ul class="nav flex-column ml-3 text-left">
            <li class="nav-item">
                <a class="nav-link <?=Yii::$app->controller->getRoute()=="my-shop/history-shopping" ? "active" : "" ?>" href="<?=Url::to(['my-shop/history-shopping']);?>">История покупок</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?=Yii::$app->controller->getRoute()=="my-shop/history-sales" ? "active" : "" ?>" href="<?=Url::to(['my-shop/history-sales']);?>">История продаж</a>
            </li>

        </ul>
    </li>
    <li class="nav-item ">
        <a href="<?=Url::to(['account/profile']);?>"  class="nav-link <?=Yii::$app->controller->getRoute()=="account/profile" ? "active" : "" ?>">Личная информация</a>

    </li>
<li class="nav-item ">
        <a href="<?=Url::to(['my-shop/messages']);?>"  class="nav-link <?=Yii::$app->controller->getRoute()=="my-shop/messages" ? "active" : "" ?>">Сообщения <?=\dasturchiuz\chatroom\NewMessageCount::widget(['userID'=>Yii::$app->user->identity->id]);?></a>

    </li>

    <?php if(Yii::$app->user->can('client_juridical')):?>
        <li class="nav-item ">
            <a href="<?=Url::to(['account/bank-details']);?>"  class="nav-link <?=Yii::$app->controller->getRoute()=="account/bank-details" ? "active" : "" ?>">Банковские реквизиты</a>
        </li>
    <?php endif;?>
    <li class="nav-item">
        <a href="<?=Url::to(['account/address']);?>"  class="nav-link <?=Yii::$app->controller->getRoute()=="account/address" ? "active" : "" ?>">Мой адрес</a>
    </li>
    <li class="nav-item ">
        <a href="<?=Url::to(['account/comment']);?>"  class="nav-link <?=Yii::$app->controller->getRoute()=="account/comment" ? "active" : "" ?>">Оценка продукта</a>
    </li>
    <li class="nav-item ">
        <a href="<?=Url::to(['account/wishlist']);?>"  class="nav-link <?=Yii::$app->controller->getRoute()=="account/wishlist" ? "active" : "" ?>">Мои желания</a>
    </li>
    <li class="nav-item ">
        <a href="<?=Url::to(['account/change-password']);?>"  class="nav-link <?=Yii::$app->controller->getRoute()=="account/change-password" ? "active" : "" ?>">Изменить пароль</a>
    </li>

</ul>
