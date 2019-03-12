<?php
use yii\widgets\DetailView;
use yii\helpers\Html;
use yii\helpers\Url;
$this->title="Мой адрес";
?>
<!-- ========================= SECTION MAIN ========================= -->
<section class="section-main bg padding-top-sm">
    <div class="container">


        <div class="row">

            <aside class="col-sm-9">
                <div class="card">
                    <article class="card-body">
                        <h4 class="title mb-4">Мой адрес - <span class="text-primary"><?=Html::encode($model->usernameid);?></span></h4>
                        <hr>
                        <div class="row mt-3">

                            <aside class="col-sm-8">
                                <article class="card-body">
                                    <?php if(Yii::$app->user->can('client') || Yii::$app->user->can('client_juridical')):?>
                                    <?php if($model->adresess!=null):?>

                                        <?=DetailView::widget([
                                            'model'=>$model->adresess,
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
                                    <?php endif;?>
                                </article> <!-- card-body.// -->
                            </aside> <!-- col.// -->

                        </div>

                    </article> <!-- card-body.// -->
                </div>

            </aside> <!-- col.// -->
            <aside class="col-md-3">
                <div class="card">
                    <article class="card-body">
                        <?=Yii::$app->controller->renderPartial("centerprofile")?>
                    </article> <!-- card-body.// -->
                </div>

            </aside> <!-- col.// -->

        </div>

    </div>
</section>



