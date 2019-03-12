<?php

//use yii\widgets\DetailView;
use yii\helpers\Html;
//use yii\helpers\Url;
use yii\grid\GridView;

$this->title = Yii::t('app', 'Мои товары');
?>
<!-- ========================= SECTION MAIN ========================= -->
<section class="section-main bg padding-top-sm">
    <div class="container">


        <div class="row">

            <aside class="col-sm-9">
                <div class="card">
                    <article class="card-body">
                        <h4 class="title mb-4"><?= Yii::t('app', 'Мои товары') ?></h4>

                        <hr>
                        <?php if (Yii::$app->session->hasFlash('error')): ?>
                            <div class="alert alert-danger" role="alert">
                                <h4 class="alert-heading">Error</h4>
                                <p><?= Yii::$app->session->getFlash('error') ?></p>

                            </div>

                        <?php endif; ?>

                        <?php if (Yii::$app->session->hasFlash('success')): ?>
                            <div class="alert alert-success" role="alert">
                                <h4 class="alert-heading">Success</h4>
                                <p><?= Yii::$app->session->getFlash('success') ?></p>

                            </div>

                        <?php endif; ?>
                        <div class="row mt-3">


                            <article class="card-body">
                                <?= GridView::widget([
                                    'dataProvider' => $dataProvider,
                                    //'filterModel' => $searchModel,
                                    'pager' => [
                                        'options' => ['class' => 'pagination justify-content-center'],
                                        'linkContainerOptions' => ['class' => 'page-item'],
                                        'linkOptions' => ['class' => 'page-link'],
                                        'disabledPageCssClass' => ['class' => 'page-link'],
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
                                    'rowOptions' => function ($model) {
                                        return $model->available == 'no' ? ['class' => 'table-danger'] : [];
                                    },
                                    'columns' => [
                                        [
                                            'class' => 'yii\grid\SerialColumn',
                                            'contentOptions' => [
                                                'class' => 'align-middle text-center'
                                            ],
                                        ],
                                        [
                                            'attribute' => 'id',
                                            'label' => "Код товара",
                                            'headerOptions' => [
                                                'class' => 'align-middle text-center'
                                            ], 'contentOptions' => [
                                            'class' => 'align-middle text-center'
                                        ],
                                            'format' => 'html',
                                            'value' => function ($data) {
                                                return Html::a($data->id, ['/product/' . $data->slug], []);
                                            }
                                        ],
                                        [
                                            'attribute' => 'feature_image',
                                            'label' => 'Фото',
                                            'format' => 'raw',
                                            'headerOptions' => [
                                                'class' => 'align-middle text-center'
                                            ],
                                            'value' => function ($data) {
                                                return '<div class="text-center">' . Html::img(Yii::getAlias('@web') . $data->getImage()->getUrl("64x"),
                                                        ['width' => '70px']) . '</div>';
                                            },
                                        ],
                                        [
                                            'attribute' => 'name',
                                            'headerOptions' => [
                                                'class' => 'align-middle text-center'
                                            ],
                                            'format'=>'html',
                                            'value'=>function($model){
                                                return $model->name."<br> <small>".\app\models\Product::getProductTypeStatus()[$model->type_product]."</small>";
                                            }
                                        ],
                                        [
                                            'attribute' => 'category_id',
                                            'format' => 'raw',
                                            'headerOptions' => [
                                                'class' => 'align-middle text-center'
                                            ],
                                            'value' => function ($data) {
                                                if ($data->category != null)
                                                    return $data->category->name;
                                                else
                                                    return "Без категории";
                                            },
                                        ],
                                        [
                                            'attribute' => 'amount',
                                            'headerOptions' => [
                                                'class' => 'align-middle text-center'
                                            ],
                                            'label' => "Кол-во"
                                        ],
                                        [
                                            'attribute' => 'price',
                                            'headerOptions' => [
                                                'class' => 'align-middle text-center'
                                            ],
                                        ],
//                                            [
//                                                'attribute' => 'available',
//                                                'headerOptions' => [
//                                                    'class' => 'align-middle text-center'
//                                                ],
//                                            ],
                                        [
                                            'class' => 'yii\grid\ActionColumn',
                                            'template' => '{viewproduct} ',
                                            'buttons' => [

                                                'viewproduct' => function ($url, $model) {
                                                    return Html::a('<i class="fa fa-eye"></i>', ['/my-shop/edit-product/', 'product_id' => $model->id], [
                                                        'title' => Yii::t('app', 'Смотреть'),
                                                    ]);
                                                },

                                            ],
                                        ],
                                    ],
                                ]); ?>

                            </article> <!-- card-body.// -->


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



