
<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
$this->title="Оформить заказ";
?>
<!-- ========================= SECTION MAIN ========================= -->
<section class="section-main bg padding-top-sm">
    <div class="container">

        <div class="row row-sm">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <?php if(Yii::$app->session->hasFlash('error')):?>
                            <div class="alert alert-danger" role="alert">
                                <h4 class="alert-heading">Ошибка</h4>
                                <p><?=Yii::$app->session->getFlash('error')?></p>

                            </div>

                        <?php endif;?>

                        <?php if(Yii::$app->session->hasFlash('success')):?>
                            <div class="alert alert-success" role="alert">
                                <h4 class="alert-heading">Успешно</h4>
                                <p><?=Yii::$app->session->getFlash('success')?></p>

                            </div>

                        <?php endif;?>
                        <?php $form=ActiveForm::begin();?>
                        <h3 class="card-title"><?=Yii::t('app', 'Оформить заказ')?></h3>



                        <div class="card-group mb-5">
                            <div class="card">

                                <div class="card-body">
                                    <h5 class="card-title"><?=Yii::t('app', 'Информация о покупателе')?></h5>
                                    <?= DetailView::widget([
                                        'model' => $foydalanuvchi,
                                        'attributes' => [

                                            'lastname',
                                            'firstname',
                                            'fathername',
                                            'tell',
                                            'email',
                                        ],
                                    ]) ?>
                                </div>
                            </div>
                            <?php if(!empty($foydalanuvchi->juridic)):?>
                                <div class="card">

                                    <div class="card-body">
                                        <h5 class="card-title">Реквизиты</h5>
                                        <?=DetailView::widget([
                                            'model'=>$foydalanuvchi->juridic,
                                            'attributes'=>[
                                                [

                                                    'attribute'=> 'status_shop_id',
                                                    'format'=>'html',
                                                    'value'=>function($model){
                                                        return "<strong style='color: red;'>".$model->statusshopp->name."</strong>";
                                                    }
                                                ],[

                                                    'attribute'=> 'tashkilot',
                                                    'format'=>'html',
                                                    'value'=>function($model){
                                                        return $model->orgon->name." ".$model->tashkilot;
                                                    }
                                                ],

                                                'bank',
                                                'hisobraqam',
                                                'inn',
                                                'mfo',
                                                'oked',
                                                'okpo',
                                                'coato',
                                                'updated_at:datetime',
                                                'created_at:datetime',
                                            ]
                                        ]);?>
                                    </div>
                                </div>
                            <?php endif;?>

                        </div>
                        <div class="card  mb-5">
                            <div class="card-body">
                                <h5 class="card-title">Информация о доставке:</h5>
                                <?php if(!empty($foydalanuvchi->adresess)):?>
                                    <?=DetailView::widget([
                                        'model'=>$foydalanuvchi->adresess,
                                        'attributes'=>[
                                            [
                                                'attribute'=>'strana_id',
                                                'format'=>'raw',
                                                'value'=>function($model){
                                                    return $model->strana->strana_name;
                                                }
                                            ],[
                                                'attribute'=>'oblast_id',
                                                'format'=>'raw',
                                                'value'=>function($model){
                                                    return $model->oblast->name_obl;
                                                }
                                            ],[
                                                'attribute'=>'city_id',
                                                'format'=>'raw',
                                                'value'=>function($model){
                                                    return $model->city->city_name;
                                                }
                                            ],
                                            'pochta_index',
                                            'street',
                                            'house',
                                            'room',
                                            'orientir',
                                        ]
                                    ]);?>
                                <?php endif;?>
                            </div>
                        </div>
                        <?php
                        $onChangeJs=<<<JS
                         alert();
                         ""
JS;
                        ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card  mb-5">
                                    <div class="card-body">
                                        <h5 class="card-title"><?=Yii::t('app', 'Условия доставки')?></h5>
                                        <?=$form->field($model, 'delivery_method')->radioList(ArrayHelper::map(\app\models\DeliveryMethod::find()->where(['status'=>1])->all(), 'id', 'deliver_name'), ['onchange'=>"$.get('".Url::toRoute('/cart/pay')."', {delevery_id : $(this).find('input:checked').val()}).done(function(data){
                            if(data.status==1){
                                $('#orders-pay_method_id').html(data.pay);
                            }
                            if(data.status==2){
                                alert('pay net');
                            }
                    });

                    if($(this).find('input:checked').val()==2){
                        $('#sklad_lits').css('display', '');
                    }else{
                                            $('#sklad_lits').css('display', 'none');

                    }
                    "])->label(false);?>
                                        <div id="sklad_lits" style="display: none;">
                                            <?=$form->field($model, 'deliver_sklad')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\product\Sklad::find()->where(['region_id_sk'=>$foydalanuvchi->region_id])->all(), 'id', function($sklad, $defaultValue){return $sklad->name_sk." Ф.И.О: ".$sklad->responsible_sk." Тел: ".$sklad->phone_sk." Адрес: ".$sklad->adress_sk;}   ), ['prompt'=>'Выберите склад']);?>

                                        </div>

                                        <!--skladlarni qilish kere-->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card  mb-5">
                                    <div class="card-body">
                                        <h5 class="card-title"><?=Yii::t('app', 'Способ оплаты')?></h5>
                                        <?=$form->field($model, 'pay_method_id')->radioList(ArrayHelper::map(\app\models\Paymethod::find()->all(), 'id', 'pay_name'))->label(false);?>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card mb-5">
                            <div class="card-body">
                                <h5 class="card-title">Комментарии:</h5>
                                <?=$form->field($model, 'custom_commenttext')->textArea()->label(false)?>
                            </div>
                        </div>
                        <div class="card  mb-5">
                            <div class="card-body">
                                <h5 class="card-title"><?=Yii::t('app', 'Детали заказа')?></h5>

                                <?php $cart_items=\app\models\Cart::getCartItemsBySeller($sellerid);
                                if($cart_items!=false):

                                    ?>

                                        <div class="card">
                                            <div class="card-header">
                                                <?php if(($seller=\app\models\Cart::getSellerById( $sellerid)) !=false): ?>

                                                    <?=Yii::t('app', 'Продавец:')?> <?=Html::a($seller['name_magazin'] !=null ? $seller['name_magazin'] : 'Bez nazivaniy', ['/shop/'.$seller['name_magazin']],['style'=>'text-decoration: underline;font-weight: 700;'])?>
                                                    <?=Html::a('<i class="fa fa-envelope" style="color: #ffaa3a;" aria-hidden="true"></i> '.Yii::t('app', 'Написать продавцу!'), ['/my-shop/send-messages', 'seller_id'=>$sellerid], ['style'=>'margin-left:20px;'])?>
                                                <?php endif;?>

                                            </div>
                                            <div class="card-body">
                                                <table class="table shopping-cart-wrap">
                                                    <thead class="text-muted">
                                                    <tr>
                                                        <th scope="col"><?= Yii::t('app', 'НАИМЕНОВАНИЕ'); ?></th>
                                                        <th scope="col"><?= Yii::t('app', 'ЦЕНА ЗА ЕДИНИЦУ'); ?></th>
                                                        <th scope="col" width="120"><?= Yii::t('app', 'КОЛИЧЕСТВО'); ?></th>

                                                        <th scope="col" width="180"><?= Yii::t('app', 'СУММА'); ?></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php $price_the_seller=0; foreach ($cart_items as $key => $item): ?>

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
                                                                        <?=$item['qty']?> / <small class="text-muted"><?=$item['unit']?></small>

                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="price-wrap">
                                                                    <var class="price"><?= number_format($item['price'] * $item['qty'], 0, ',', ' ') ?>  <?= Yii::t('app', 'сум'); ?></var>
                                                                    <?php $price_the_seller+= $item['price'] * $item['qty'];?>
                                                                </div> <!-- price-wrap .// -->
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
                                                                <td > <?= count($cart_items); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>На сумму:</td>
                                                                <td><?= number_format($price_the_seller, 0, ',', ' ') ?>  <?= Yii::t('app', 'сум'); ?> </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3">
                                                                    <div class="float-right">
                                                                        <?=$form->field($model, 'termsofuse')->checkbox();?>
                                                                        <?= Html::submitButton(Yii::t('app', 'Оформить заказ'), ['class' => 'btn btn-primary float-right']) ?>



                                                                    </div>

                                                                </td>

                                                            </tr>

                                                        </table>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>



















                                <?php  else: ?>
                                    <h3>Карзина пуста</h3>
                                <?php endif;?>

                            </div>
                        </div>




                        <?php ActiveForm::end();?>

                    </div>
                </div>
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
                    <li class="col-md-5"><a href="#"><i class="icon fa fa-shopping-cart"></i><span>Торговое содействие</span></a></li>
                    <li class="col-md-5"><a href="#"><i class="icon fa fa-briefcase"></i><span>Бизнес-идентификация</span></a></li>
                    <li class="col-md-5"><a href="#"><i class="icon fa fa-plane"></i><span>Доставка по всему Узбекистану</span></a></li>
                    <li class="col-md-5"><a href="#"><i class="icon fa fa-phone"></i><span>Служба поддержки</span></a></li>
                    <li class="col-md-5"><a href="#"><i class="icon fa fa-lock"></i><span>Обеспеченный платеж</span></a></li>
                    <li class="col-md-5"><a href="#"><i class="icon fa fa-bars"></i> <span>Другие услуги</span></a></li>
                </ul>
            </div> <!-- col // -->
        </div><!-- row // -->
        <br>
    </div><!-- container // -->
</section>
