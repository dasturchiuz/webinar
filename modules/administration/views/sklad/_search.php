<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\product\SkladSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sklad-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name_sk') ?>

    <?= $form->field($model, 'region_id_sk') ?>

    <?= $form->field($model, 'adress_sk') ?>

    <?= $form->field($model, 'phone_sk') ?>

    <?php // echo $form->field($model, 'responsible_sk') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
