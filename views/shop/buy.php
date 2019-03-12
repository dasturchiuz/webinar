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
            <div class="col-md-12">
                <div class="card">
                    <article class="card-body">
                        <h4 class="title">Добро пожаловать в <?=$profile->name_magazin?> <span class="text-primary"> Пакупаю </span> </h4>

                    </article> <!-- card-body.// -->
                </div>
            </div>

        </div>
        <div class="row row-sm mb-3">
            <aside class="col-md-3">
                <?=$this->render('shop', compact('profile'));?>

            </aside> <!-- col.// -->

            <div class="col-md-9">


                <?=yii\widgets\ListView::widget([
                    'dataProvider'=>$dataProvider,


                    'layout' => "\n
                            <div class='row'>
                                {items}
                            </div>\n",
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
                        'id' => 'cont',
                    ],
                ]);?>
            </div>


        </div>




    </div>

</section>


