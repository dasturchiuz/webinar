<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title=Yii::t('app', 'Дилеры');
?>
<!-- ========================= SECTION MAIN ========================= -->
<section class="section-main bg padding-top-sm">
    <div class="container">
        <div class="row row-sm mb-3">
            <div class="col-md-12">
                <div class="card">
                    <article class="card-body">
                        <h4 class="title-text"><?= $this->title; ?>

                    </article> <!-- card-body.// -->
                </div>
            </div>

        </div>

<div class="row">
    <div class="col-md-3">
        <div class="card">
            <article class="card-body">
                Место для рекламы



            </article> <!-- card-body.// -->
        </div>
    </div>
    <div class="col-md-9">
        <?=yii\widgets\ListView::widget([
            'dataProvider'=>$dataProvider,


            'layout' => "{items}",
            'summary'=>"<div>".Yii::t('app', "Тавары")." {begin} - {end} ".Yii::t('app', "из")." {totalCount} </div>",
            'itemView' => function ($model, $key, $index, $widget) {
                return $this->render('_itemDealer',['model' => $model, 'index'=>$index]);

                // or just do some echo
                // return $model->title . ' posted by ' . $model->author;
            },
            'emptyText'=>"<h3>Результатов не найдено.</h3>",
            'itemOptions' => [
                'tag' => false,
            ],
            'options' => [
                'tag' => 'div',
                'class' => 'container',
            ],
        ]);?>
    </div>


</div>


                    </div> <!-- card.// -->

</section>

