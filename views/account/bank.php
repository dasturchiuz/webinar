<?php
use yii\widgets\DetailView;
use yii\helpers\Html;
use yii\helpers\Url;
$this->title="Банковские реквизиты";
?>
<!-- ========================= SECTION MAIN ========================= -->
<section class="section-main bg padding-top-sm">
    <div class="container">


        <div class="row">

            <aside class="col-sm-9">
                <div class="card">
                    <article class="card-body">
                        <h4 class="title mb-4"><?=$this->title?> - <span class="text-primary"><?=Html::encode($model->usernameid);?></span></h4>
                        <hr>
                        <div class="row mt-3">

                            <aside class="col-sm-8">
                                <article class="card-body">
                                    <?php if($model->juridic!=null):?>
                                        <?=DetailView::widget([
                                            'model'=>$model->juridic,
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



