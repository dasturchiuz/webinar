<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Productreviews */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="productreviews-form">

    <?php $form = ActiveForm::begin(); ?>

    <?//= $form->field($model, 'user_id')->textInput() ?>

    <?//= $form->field($model, 'product_id')->textInput() ?>

    <?//= $form->field($model, 'star_rating')->textInput() ?>

    <?//= $form->field($model, 'otziv_text')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([0=>'No', 1=>'yes'], ['prompt'=>'select']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
