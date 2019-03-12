<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Paymethod */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="paymethod-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pay_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'payment_status')->textInput() ?>
    <?= $form->field($model, 'delivery_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\DeliveryMethod::find()->where(['status'=>1])->all(), 'id', 'deliver_name'), ['prompt'=>'Выберите']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
