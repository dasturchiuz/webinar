<?php
use yii\widgets\DetailView;
use yii\helpers\Html;
use yii\helpers\Url;
$this->title=Html::encode($model->title);
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

            <aside class="col-sm-12">
                <div class="card">
                    <article class="card-body">
                        <h4 class="title mb-4"><?=Html::encode($this->title);?> <?php if(Yii::$app->user->can('super_admin')) : ?>    <?= Html::a(Yii::t('app', 'Редактировать  '),['/administration/page/update', 'id'=>$model->id] ,['class' => 'btn btn-info']) ?>   <?php endif;?>      </h4>
                        <hr>
                        <div class="row mt-3">

                            <aside>
                                <article class="card-body">
                                    <?=$model->content?>
                                </article> <!-- card-body.// -->
                            </aside> <!-- col.// -->


                        </div>

                    </article> <!-- card-body.// -->
                </div>

            </aside> <!-- col.// -->


        </div>

    </div>
</section>



