<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use pendalf89\filemanager\widgets\TinyMCE;
/* @var $this yii\web\View */
/* @var $model app\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-9">
            <div class="box box-primary with-border">

                <div class="box-body">
                    <?= $form->field($model, 'title')->textInput() ?>
                    <?= $form->field($model, 'content')->widget(TinyMCE::className(), [
                        'clientOptions' => [
                            'language' => 'ru',
                            'menubar' => false,
                            'height' => 200,
                            'image_dimensions' => false,
                            'plugins' => [
                                'advlist autolink lists link image charmap print preview anchor searchreplace visualblocks code contextmenu table',
                            ],
                            'toolbar' => 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code',
                        ],
                    ])->label(false); ?>

                    <?= $form->field($model, 'meta_description')->textarea(['rows' => 6]) ?>

                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
        <div class="col-md-3">
            <div class="box box-primary  with-border">

                <div class="box-body">
                    <?= $form->field($model, 'status')->dropDownList(\app\models\Article::getStatuses(), ['prompt'=>'Выбрити']) ?>
                    <?= $form->field($model, 'meta_keywords')->textarea(['rows' => 3]) ?>

                    <div class="row">
                        <div class="col-md-8">
                            <?= $form->field($model, 'in_menu')->checkbox() ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($model, 'sort')->textInput(['type' =>'number']) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <?php if(!$model->isNewRecord):?>
                                <div class="form-group">
                                    <?= Html::a(Yii::t('app', 'Просмотреть '),['/page/'.$model->slug] ,['class' => 'btn btn-info']) ?>
                                </div>
                            <?php endif;?>
                        </div>
                        <div class="col-md-6">

                            <div class="form-group text-right">
                                <?= Html::submitButton(Yii::t('app', $model->isNewRecord ? 'Сохранить' : 'Обновить'), ['class' => 'btn btn-success ']) ?>
                            </div>
                        </div>
                    </div>



                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>

    </div>
    <?php ActiveForm::end(); ?>


</div>
