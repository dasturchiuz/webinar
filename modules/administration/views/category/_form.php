<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use pendalf89\filemanager\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>
<?php $encoded = \yii\helpers\ArrayHelper::htmlEncode(\app\models\Category::getCategories());?>
    <?= $form->field($model, 'parent_id')->dropDownList(\yii\helpers\ArrayHelper::map($encoded, 'id', 'name'), ['prompt'=>'Выберите..']) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>
    <?php

    echo $form->field($model, 'image')->widget(FileInput::className(), [
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
    <?= $form->field($model, 'image')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'sort')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
