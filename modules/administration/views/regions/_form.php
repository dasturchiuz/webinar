<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Regions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="regions-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'strana_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Strana::find()->all(), 'id', 'strana_name'), ['prompt'=>'Выберите']) ?>

    <?= $form->field($model, 'name_obl')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList(\app\models\Regions::getStatuses(), ['prompt'=>"Выберите"]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
