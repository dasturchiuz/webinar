<?php
use yii\widgets\DetailView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
$this->title="Оценка продукта";
?>
<!-- ========================= SECTION MAIN ========================= -->
<section class="section-main bg padding-top-sm">
    <div class="container">


        <div class="row">

            <aside class="col-sm-9">
                <div class="card">
                    <article class="card-body">
                        <h4 class="title mb-4">Оценка продукта </h4>
                        <hr>
                        <?=GridView::widget([
                            'dataProvider'=>$model,
                            'layout'=>"  \n {summary} \n {items} {pager}",
                            'summary'=>"<div class='float-right'>".Yii::t('app', "Отзывы")." {begin} - {end} ".Yii::t('app', "из")." {totalCount} </div>",
                            'columns'=>[
                                [
                                    'class'=>'yii\grid\SerialColumn',

                                ],
//                                'id',
                                [
                                    'attribute'=>'product_id',
                                    'format'=>'html',
                                    'value'=>function($model){
                                        return Html::a($model->product->name, ['product/'.$model->product->slug]);
                                    }
                                ],
                                [
                                    'attribute'=>'star_rating',
                                    'format'=>'html',
                                    'value'=>function($model){
                                        return '<div class="stars-wrap">
        <ul class="list-rating">
            <li style="width:'.($model->star_rating*20).'%" class="stars-active">
                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
            </li>
            <li>
                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
            </li>
        </ul>
    </div>';
                                    }
                                ],
                                'otziv_text',
//                                'status',
                                'created_at:date',

                            ],
                        ]);?>

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


