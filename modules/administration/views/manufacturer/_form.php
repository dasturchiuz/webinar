<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use pendalf89\filemanager\widgets\TinyMCE;
use pendalf89\filemanager\widgets\FileInput;
/* @var $this yii\web\View */
/* @var $model app\models\Manufacturer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="manufacturer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'strana_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Strana::find()->asArray()->all(), 'id', 'strana_name'), ['prompt'=>'Выберите страну производитель ']) ?>

    <?php //= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'img_logo')->widget(FileInput::className(), [
        'buttonTag' => 'button',
        'buttonName' => 'Browse',
        'buttonOptions' => ['class' => 'btn btn-default'],
        'options' => ['class' => 'form-control'],
        // Widget template
        'template' => '<div class="input-group">{input}<span class="input-group-btn">{button}</span></div>',
        // Optional, if set, only this image can be selected by user
        'thumb' => 'original',
        // Optional, if set, in container will be inserted selected image
        'imageContainer' => '.img',
        // Default to FileInput::DATA_URL. This data will be inserted in input field
        'pasteData' => FileInput::DATA_URL,
        // JavaScript function, which will be called before insert file data to input.
        // Argument data contains file data.
        // data example: [alt: "Ведьма с кошкой", description: "123", url: "/uploads/2014/12/vedma-100x100.jpeg", id: "45"]
        'callbackBeforeInsert' => 'function(e, data) {
        console.log( data );
    }',
    ]);
    ?>

    <?= $form->field($model, 'desc')->widget(TinyMCE::className(), [
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
    ]); ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
