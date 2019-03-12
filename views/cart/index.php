<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title=Yii::t('app', 'Ваша корзина');
?>
<!-- ========================= SECTION MAIN ========================= -->
<section class="section-main bg padding-top-sm">
    <div class="container">

        <div class="row row-sm">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="title-text"><?= $this->title; ?>
                            <?php if (!empty($session['cart'])): ?>
                            <small>(<?php if (!empty($_SESSION['cart'])) {
                                    echo count($_SESSION['cart']);
                                } ?> товара(ов))
                            </small>
                            <?php endif; ?>
                        </h4>
                        <?php if (!empty($session['cart'])): ?>


                                <?php $form = ActiveForm::begin(); ?>
                                <pre>
        <?php

        ?>
    </pre>
                                <?php $cart_items=\app\models\Cart::getCartItemsBySeller();
                                if($cart_items!=false):?>
                                <?php foreach ($cart_items as $seller_id => $product):?>
                                    <div class="card">
                                        <div class="card-header">
                                            <?php if(($seller=\app\models\Cart::getSellerById( $seller_id)) !=false): ?>

                                                <?=Yii::t('app', 'Продавец:')?> <?=Html::a($seller['name_magazin'] !=null ? $seller['name_magazin'] : 'Bez nazivaniy', ['/shop/'.$seller['name_magazin']],['style'=>'text-decoration: underline;font-weight: 700;'])?>
                                                <?=Html::a('<i class="fa fa-envelope" style="color: #ffaa3a;" aria-hidden="true"></i> '.Yii::t('app', 'Написать продавцу!'), ['/my-shop/send-messages', 'seller_id'=>$seller_id], ['style'=>'margin-left:20px;'])?>

                                            <?php endif;?>

                                        </div>
                                        <div class="card-body">
                                            <table class="table table-hover shopping-cart-wrap">
                                                <thead class="text-muted">
                                                <tr>
                                                    <th scope="col"><?= Yii::t('app', 'НАИМЕНОВАНИЕ'); ?></th>
                                                    <th scope="col"><?= Yii::t('app', 'ЦЕНА ЗА ЕДИНИЦУ'); ?></th>
                                                    <th scope="col" width="120"><?= Yii::t('app', 'КОЛИЧЕСТВО'); ?></th>

                                                    <th scope="col" width="180"><?= Yii::t('app', 'СУММА'); ?></th>
                                                    <th scope="col" width="130"><?= Yii::t('app', ''); ?></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $price_the_seller=0; foreach ($product as $key => $item): ?>

                                                    <tr>
                                                        <td>
                                                            <figure class="media">
                                                                <div class="img-wrap"><img src="<?= $item['img'] ?>"
                                                                                           class="img-thumbnail img-sm" alt="<?=$item['name']?>"></div>
                                                                <figcaption class="media-body">
                                                                    <h6 class="title text-truncate"><?=Html::a($item['name'], ['/product/'.$item['slug']], [])  ?></h6>

                                                                </figcaption>
                                                            </figure>
                                                        </td>
                                                        <td>
                                                            <div class="price-wrap">
                                                                <var class="price"><?= number_format($item['price'], 0, ',', ' ') ?>  <?= Yii::t('app', 'сум'); ?></var>

                                                            </div> <!-- price-wrap .// -->
                                                        </td>
                                                        <td>

                                                            <div class="form-group row">
                                                                <div class="col-10">
                                                                    <?= $form->field($model, 'cart_item[' . $key . ']')->textInput(['type' => 'number', 'value' => $item['qty']])->label(false); ?>

                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="price-wrap">
                                                                <var class="price"><?= number_format($item['price'] * $item['qty'], 0, ',', ' ') ?>  <?= Yii::t('app', 'сум'); ?></var>
                                                                <?php $price_the_seller=+ $item['price'] * $item['qty'];?>
                                                            </div> <!-- price-wrap .// -->
                                                        </td>
                                                        <td class="text-right">

                                                            <a href="" data-id="<?= $key; ?>"
                                                               class="btn btn-outline-danger dell-itemkorzina"> <i
                                                                        class="fas fa-trash-alt"></i></a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>

                                                </tbody>
                                            </table>
                                            <div class="row">
                                                <div class="col-md-8">

                                                </div>
                                                <div class="col-md-4">
                                                    <table  class="table ">
                                                        <tr>
                                                            <td>Итого:</td>
                                                            <td > <?= count($product); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>На сумму:</td>
                                                            <td><?= number_format(\app\models\Cart::getCartBySellerSum($product), 0, ',', ' ') ?>  <?= Yii::t('app', 'сум'); ?> </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="3">
                                                                <div class="float-right">
                                                                    <?= Html::submitButton(Yii::t('app', 'Обновить корзину'), ['class' => 'btn btn-primary btn-sm']) ?>
                                                                    <a href="<?= Url::to(['/cart/checkout-by-seller', 'sellerid'=>$seller_id]); ?>"
                                                                       class="btn btn-warning  btn-sm"><?= Yii::t('app', 'Заказать у этого продавца'); ?></a>


                                                                </div>

                                                            </td>

                                                        </tr>

                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach;?>
                                    <div class="row">
                                        <div class="col-md-8">

                                        </div>
                                        <div class="col-md-4">
                                            <table  class="table ">
                                                <tr>
                                                    <td>Итого:</td>
                                                    <td > <?= Yii::$app->session->get('cart.qty'); ?></td>
                                                </tr>
                                                <tr>
                                                    <td>На сумму:</td>
                                                    <td><?= number_format($session['cart.sum'], 0, ',', ' ') ?>  <?= Yii::t('app', 'сум'); ?> </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3">
                                                        <div class="float-right">
                                                            <?= Html::submitButton(Yii::t('app', 'Обновить корзину'), ['class' => 'btn btn-primary']) ?>
                                                            <a href="<?= Url::to(['/cart/checkout']); ?>"
                                                               class="btn btn-warning"><?= Yii::t('app', 'Оформить заказ'); ?></a>


                                                        </div>

                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td colspan="3">
                                                        <div class="float-right">
                                                            <button type="button" class="btn btn-danger clearcart"
                                                                    id="clearcart"><?= Yii::t('app', 'Очистить корзину'); ?></button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>

                                    </div>


                                <?php endif;?>





                            <?php ActiveForm::end(); ?>


                        <?php else: ?>

                            <h3 class="card-title"><?= Yii::t('app', 'Карзина пусто'); ?></h3>

                        <?php endif; ?>
                    </div> <!-- card.// -->

                </div>
            </div>
        </div>
</section>


<section class="section-links padding-top">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <header class="section-heading">
                    <h2 class="title-section">Поставщики по регионам</h2>
                </header><!-- sect-heading -->
                <ul class="list-icon row">
                    <li class="col-md-4"><a href="#"><span>Ташкент</span></a></li>
                    <li class="col-md-4"><a href="#"><span>Самарканд</span></a></li>
                    <li class="col-md-4"><a href="#"><span>Джизак</span></a></li>
                    <li class="col-md-4"><a href="#"><span>Фергана</span></a></li>
                    <li class="col-md-4"><a href="#"><span>Андижан</span></a></li>
                    <li class="col-md-4"><a href="#"> <span>Больше регионов</span></a></li>
                </ul>
            </div> <!-- col // -->
            <div class="col-md-6">
                <header class="section-heading">
                    <h2 class="title-section">Наши торговые услуги </h2>
                </header><!-- sect-heading -->
                <ul class="list-icon row">
                    <li class="col-md-5"><a href="#"><i
                                    class="icon fa fa-shopping-cart"></i><span>Торговое содействие</span></a></li>
                    <li class="col-md-5"><a href="#"><i
                                    class="icon fa fa-briefcase"></i><span>Бизнес-идентификация</span></a></li>
                    <li class="col-md-5"><a href="#"><i
                                    class="icon fa fa-plane"></i><span>Доставка по всему Узбекистану</span></a></li>
                    <li class="col-md-5"><a href="#"><i class="icon fa fa-phone"></i><span>Служба поддержки</span></a>
                    </li>
                    <li class="col-md-5"><a href="#"><i class="icon fa fa-lock"></i><span>Обеспеченный платеж</span></a>
                    </li>
                    <li class="col-md-5"><a href="#"><i class="icon fa fa-bars"></i> <span>Другие услуги</span></a></li>
                </ul>
            </div> <!-- col // -->
        </div><!-- row // -->
        <br>
    </div><!-- container // -->
</section>