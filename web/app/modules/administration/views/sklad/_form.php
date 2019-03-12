<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Sklad */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sklad-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sklad_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sklad_region')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
