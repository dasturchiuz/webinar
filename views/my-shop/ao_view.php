<?php

use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\money\MaskMoney;
use yii2assets\printthis\PrintThis;

$this->title = "Заказы №" . $model->id
?>
<!-- ========================= SECTION MAIN ========================= -->
<section class="section-main bg padding-top-sm">
    <div class="container">

        <div class="card">
            <div class="row">

                <aside class="col-sm-12">
                    <article class="card-body-lg">
                        <?php if (!empty($model)): ?>
                            <h3 class="title mb-3">Заказы № <?= $model->id ?></h3>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title"><?= Yii::t('app', 'Информация о доставке') ?></h5>
                                            <?php if ($model->profile->adresess != null): ?>

                                                <?= DetailView::widget([
                                                    'model' => $model->profile->adresess,
                                                    'options' => [
                                                        'class' => 'table mb-0'
                                                    ],
                                                    'attributes' => [
                                                        [
                                                            'label' => 'Адрес:',
                                                            'format' => 'html',
                                                            'value' => function ($model) {
                                                                return $model->city->city_name . ", " . $model->oblast->name_obl . ", " . $model->strana->strana_name . " <b>Улица:</b>" .
                                                                    $model->street . ",  <b>Дом:</b> " . $model->house . "<b> Квартира: </b>" . $model->room;
                                                            }
                                                        ],
                                                        [
                                                            'label' => "Тел:",
                                                            'value' => function ($model) {
                                                                return $model->profile->tell;
                                                            }
                                                        ],
                                                        'orientir',
                                                        'pochta_index',

                                                    ]
                                                ]); ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title"><?= Yii::t('app', 'Информация о заказе') ?></h5>
                                            <table class="table">

                                                <tr>
                                                    <td width="15%">
                                                    <span class="label label-primary"><i
                                                                class="fa fa-user"></i></span>
                                                    </td>
                                                    <td>

                                                        <?= Html::encode($model->profile->fullnameemp) ?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td width="15%">
                                                    <span class="label label-primary"><i
                                                                class="fa fa-shopping-bag"></i></span>
                                                    </td>
                                                    <td>

                                                        <?= Html::a($model->profile->name_magazin, ['/shop/' . $model->profile->name_magazin], []) ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="15%">
                                                    <span class="label label-primary"><i
                                                                class="fa fa-calendar"></i></span>
                                                    </td>
                                                    <td>

                                                        <?= Html::encode(date('Y-m-d H:m:s', $model->created_at)) ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="15%">
                                                        <span class="label label-primary"><i
                                                                    class="fa fa-credit-card"></i></span>
                                                    </td>
                                                    <td>
                                                        <?= Html::encode($model->pay_method_name) ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="15%">
                                                    <span class="label label-primary"><i
                                                                class="fa fa-truck "></i></span>
                                                    </td>
                                                    <td>
                                                        <?= $model->delivery->deliver_name ?>
                                                    </td>
                                                </tr>


                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title"><?= Yii::t('app', 'Действие') ?></h5>

                                            <?= Html::a(Yii::t('app', 'Отдал заказ'), ['status-order', 'order_id' => $model->id, 'status' => 1], [

                                                'class' => $model->status == \app\models\Orders::STATUS_ZAKUPKA || $model->status == \app\models\Orders::STATUS_ZAKUPKA_OTKAZ ? 'btn btn-primary btn-block disabled' : 'btn btn-primary btn-block',
                                                'data' => [
                                                    'confirm' => Yii::t('app', 'Заказ доставлен?'),
                                                    'method' => 'post',
                                                ],
                                            ]) ?>

                                            <?= Html::a(Yii::t('app', 'Аннулировать заказ'), ['status-order', 'order_id' => $model->id, 'status' => 2], [
                                                'class' => $model->status == \app\models\Orders::STATUS_ZAKUPKA || $model->status == \app\models\Orders::STATUS_ZAKUPKA_OTKAZ ? 'btn btn-danger btn-block disabled' : 'btn btn-danger btn-block',
                                                'data' => [
                                                    'confirm' => Yii::t('app', 'Вы хотите отменить свой заказ?'),
                                                    'method' => 'post',
                                                ],
                                            ]) ?>

                                            <table class="table">

                                                <tr>
                                                    <td width="15%">
                                                        <span class="label label-primary"><i
                                                                    class="fa fa-money-bill-alt"></i></span>
                                                    </td>
                                                    <td>
                                                        <?= Html::encode(number_format($model->sum, 0, ',', ' ') . " сум") ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="15%">
                                                        <span class="label label-primary"><i
                                                                    class="fa fa-envelope-open"></i></span>
                                                    </td>
                                                    <td>
                                                        <?= Html::encode($model->statuses[$model->status]) ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="15%">
                                                        <span class="label label-primary"><i
                                                                    class="fa fa-check-square "></i></span>
                                                    </td>
                                                    <td>
                                                        <?= Html::encode($model->statuses[$model->pay_status]) ?>
                                                    </td>
                                                </tr>


                                            </table>
                                        </div>
                                    </div>
                                </div>


                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?= Yii::t('app', 'Детали заказа') ?></h5>
                                    <div class="table-responsive">
                                        <table class="table table-hover shopping-cart-wrap">
                                            <thead class="text-muted">
                                            <tr>
                                                <th scope="col"><?= Yii::t('app', 'НАИМЕНОВАНИЕ'); ?></th>
                                                <th scope="col"
                                                    width="140"><?= Yii::t('app', 'ЦЕНА ЗА ЕДИНИЦУ'); ?></th>
                                                <th scope="col" width="120"><?= Yii::t('app', 'КОЛИЧЕСТВО'); ?></th>

                                                <th scope="col" width="180"><?= Yii::t('app', 'СУММА'); ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php foreach ($model->orderItems as $id => $item): ?>
                                                <tr>
                                                    <td><a href="/product/<?= $item->product->slug; ?>">
                                                            <figure class="media">
                                                                <div class="img-wrap"><img
                                                                            src="<?= $item->product->getImage()->getUrl() ?>"
                                                                            class="img-thumbnail img-sm"></div>
                                                                <figcaption class="media-body">
                                                                    <h6 class="title text-truncate"><?= $item->name ?></h6>
                                                                </figcaption>
                                                            </figure>
                                                        </a>
                                                    </td>
                                                    <td>

                                                        <?= number_format($item->price, 0, ',', ' ') ?> <?= Yii::t('app', 'сум'); ?>
                                                    </td>


                                                    <td>
                                                        <?= $item->qty_item ?> /
                                                        <small class="text-muted"><?php if ($item->product->unit != null) echo $item->product->unit->unit_name; ?></small>
                                                    </td>
                                                    <td>
                                                        <div class="price-wrap">
                                                            <var class="price"><?= number_format($item->summ_item, 0, ',', ' ') ?> <?= Yii::t('app', 'сум'); ?></var>
                                                        </div> <!-- price-wrap .// -->
                                                    </td>

                                                </tr>
                                            <?php endforeach; ?>
                                            <tr>
                                                <td colspan="1">

                                                </td>
                                                <td colspan="2">
                                                    <strong> <?= Yii::t('app', 'ВСЕГО:') ?></strong>
                                                </td>
                                                <td>
                                                    <strong><?= number_format($model->sum, 0, ',', ' ') ?>  <?= Yii::t('app', 'сум'); ?></strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="1">

                                                </td>
                                                <td colspan="2">
                                                    <strong><?= Yii::t('app', 'ИТОГО:') ?></strong>
                                                </td>
                                                <td>
                                                    <strong><?= number_format($model->sum, 0, ',', ' ') ?>  <?= Yii::t('app', 'сум'); ?></strong>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        <?php else: ?>
                            <h3 class="title mb-3">Заказы не существует</h3>
                        <?php endif; ?>
                    </article> <!-- card-body.// -->
                </aside> <!-- col.// -->
            </div>
        </div>
    </div>
</section>

<?php if(Yii::$app->user->can('client_juridical')):?>
<section class="section-main bg padding-top-sm">
    <div class="container">

        <div class="card">
            <article class="card-body-lg">
                <?=$this->render('invoice', compact('model'))?>
            </article>
        </div>
    </div>
</section>
<?php endif;?>