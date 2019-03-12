<?php
use yii\widgets\DetailView;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\file\FileInput;

$this->title="Личная информация";
?>
<!-- ========================= SECTION MAIN ========================= -->
<section class="section-main bg padding-top-sm">
    <div class="container">


        <div class="row">

            <aside class="col-sm-9">
                <div class="card">
                    <article class="card-body">
                        <h4 class="title mb-4">Личная информация - <span class="text-primary"><?=Html::encode($model->usernameid);?></span></h4>
                        <hr>
                        <div class="row mt-3">

                            <aside class="col-sm-6">
                                <article class="card-body">
                                    <?=DetailView::widget([
                                        'model'=>$model,
                                        'attributes'=>[
                                            [
                                                'attribute'=>'region_id',
                                                'value'=>$model->oblast->name_obl,
                                            ],
                                            'firstname',
                                            'lastname',
                                            'fathername',
                                            'tell',
//                                            'adress',
                                        ],
                                    ]);?>
                                </article> <!-- card-body.// -->
                            </aside> <!-- col.// -->
                            <aside class="col-sm-6">
                                <article class="card-body">
                                    <?php $form=\yii\widgets\ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);?>
                                        <?=$form->field($modelProfile, 'user_image')->widget(FileInput::classname(), [
                                        'pluginOptions' => [

                                            'showRemove' => false,
                                            'showUpload' => false,
                                            'browseClass' => 'btn btn-primary btn-block',
                                            'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                                            'browseLabel' =>  'Select Photo'
                                        ],
                                        'options' => ['accept' => 'image/*']
                                    ])->label(false);?>
                                    <div class="form-group">
                                        <?=Html::submitButton('Сохранить', ['class'=>'btn-block btn btn-primary'])?>
                                    </div>
                                    <?php \yii\widgets\ActiveForm::end();?>
                                </article> <!-- card-body.// -->
                            </aside> <!-- col.// -->

                        </div>
                        <div class="row mt-3">
                            <?=Html::img(['/account/logo'], ['width' => '400px'])?>


                            <?php if($model->is_juridical==1): ?>
                                <aside class="col-sm-6">
                                    <article class="card-body">
                                        <?=DetailView::widget([
                                            'model'=>$model->juridic,
                                            'attributes'=>[
                                                'tashkilot',
                                                'bank',
                                                'hisobraqam',
                                                'inn',
                                                'mfo',
                                                'isjuridic',
                                                'oked',

                                            ],
                                        ]);?>
                                    </article> <!-- card-body.// -->
                                </aside> <!-- col.// -->
                            <?php endif;?>

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



