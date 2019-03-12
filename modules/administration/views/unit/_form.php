<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Unit */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="unit-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'unit_name')->textInput(['maxlength' => true]) ?>




    <?= $form->field($model, 'unit_desc')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'status')->dropDownList([10 =>"Active", 0=>"Inactive"]); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
