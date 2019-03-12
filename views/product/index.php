<?php

$this->title="Alior.uz";
?>
<!-- ========================= SECTION MAIN ========================= -->
<section class="section-main  padding-top-sm">
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

        <div class="row row-sm mb-3">
            <aside class="col-md-3">
<!--                <div class="sticky-top">-->
                    <?php  $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/views/product/');?>
                    <?=$this->render(
                        'category.php',
                        ['directoryAsset' => $directoryAsset, 'searchModel'=>$searchModel]
                    ) ?>

<!--                </div>-->


            </aside> <!-- col.// -->

            <div class="col-md-9">
                <?=yii\widgets\ListView::widget([
                    'dataProvider'=>$dataProvider,
                    'pager'=>[
                        'options'=>['class'=>'pagination justify-content-center'],
                        'linkContainerOptions'=>['class'=>'page-item'],
                        'linkOptions'=>['class'=>'page-link'],
                        'disabledPageCssClass'=>['class'=>'page-link'],
                    ],

                    'layout' => "\n
                            <div class='row'>
                                {items}
                            </div> \n <nav aria-label=\"Page navigation example\">{pager} </nav>",
                    'summary'=>"<div>".Yii::t('app', "Тавары")." {begin} - {end} ".Yii::t('app', "из")." {totalCount} </div>",
                    'itemView' => function ($model, $key, $index, $widget) {
                        return $this->render('_item',['model' => $model, 'index'=>$index]);

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
                        'id' => 'cont',
                    ],
                ]);?>
            </div>


        </div>

        <hr>



    </div>

</section>


