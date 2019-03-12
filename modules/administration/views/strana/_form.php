<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Strana */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="strana-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'strana_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sort_strana')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
