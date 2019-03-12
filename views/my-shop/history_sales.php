<?php

use yii\widgets\DetailView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

$this->title = "История продажи";
?>
<!-- ========================= SECTION MAIN ========================= -->
<section class="section-main bg padding-top-sm">
    <div class="container">
        <?php if(Yii::$app->session->hasFlash('error')):?>
            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Error</h4>
                <p><?=Yii::$app->session->getFlash('error')?></p>

            </div>

        <?php endif;?>

        <?php if(Yii::$app->session->hasFlash('success')):?>
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Success</h4>
                <p><?=Yii::$app->session->getFlash('success')?></p>

            </div>

        <?php endif;?>

        <div class="row">

            <aside class="col-sm-9">
                <div class="card">
                    <article class="card-body">
                        <h4 class="title mb-4"><?=Html::encode($this->title)?></h4>
                        <hr>
                        <div class="row mt-3">

                            <aside class="col-sm-12">
                                <article class="card-body">
                                    <?= GridView::widget([
                                        'dataProvider' => $orders,
                                        'pager'=>[
                                            'options'=>['class'=>'pagination justify-content-center'],
                                            'linkContainerOptions'=>['class'=>'page-item'],
                                            'linkOptions'=>['class'=>'page-link'],
                                            'disabledPageCssClass'=>['class'=>'page-link'],
                                        ],
                                        'options' => [
                                            'class' => 'table-responsive-md',
                                        ],
                                        'layout' => "{items} \n <nav aria-label=\"Page navigation example\">{pager} </nav>",
                                        'tableOptions' => [
                                            'class' => 'table '
                                        ],
                                        'headerRowOptions' => [
                                            'class' => 'thead-light'
                                        ],
                                        'columns' => [
                                            [
                                                'class' => 'yii\grid\SerialColumn',

                                            ],
                                            'id',
                                            [
                                                'format' => 'raw',
                                                'attribute' => 'status',
                                                'value' => function ($model) {
                                                    return $model->statuses[$model->status];
                                                },
                                                'headerOptions' => [
                                                    'style' => 'width:20%'
                                                ],
                                            ],
                                            [
                                                'format' => 'raw',
                                                'attribute' => 'pay_status',
                                                'value' => function ($model) {
                                                    return $model->statuses[$model->pay_status];
                                                },
                                            ],
                                            [
                                                'attribute' => 'created_at',
                                                'value'=>function($model){
                                                    return gmdate("d.m.Y H:i:s", $model->created_at);
                                                }
                                            ],
                                            //'qty',
                                            [
                                                'attribute' => 'sum',
                                                'format' => 'raw',
                                                'value' => function ($model) {
                                                    return number_format($model->sum, 0, ',', ' ') . Yii::t('app', ' сум');
                                                }
                                            ],
                                            [
                                                'class' => 'yii\grid\ActionColumn',
                                                'template' => "{pay} {cancelled} {order_view}",
                                                'buttons' => [
                                                    'order_view' => function ($url, $model, $key) {
                                                        return Html::a('<i class="fas fa-eye"></i>', ['/my-shop/accepted-order-view', 'id' => $model->id]);
                                                    },

                                                ],
                                            ],
                                        ],
                                    ]); ?>

                                </article> <!-- card-body.// -->
                            </aside> <!-- col.// -->

                        </div>

                    </article> <!-- card-body.// -->
                </div>

            </aside> <!-- col.// -->
            <aside class="col-md-3">
                <div class="card">
                    <article class="card-body">
                        <?= Yii::$app->view->render("/account/centerprofile") ?>
                    </article> <!-- card-body.// -->
                </div>

            </aside> <!-- col.// -->

        </div>

    </div>
</section>



