<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\NotifyType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="notify-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'notfy_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'notfy_template')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
