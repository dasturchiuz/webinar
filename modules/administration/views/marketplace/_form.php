<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Marketplace;
/* @var $this yii\web\View */
/* @var $model app\models\Marketplace */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="marketplace-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'market_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([Marketplace::STATUS_ON=>'Активный', Marketplace::STATUS_OFF=>'Деактивный', ], ['prompt'=>'Выберите статус']) ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
