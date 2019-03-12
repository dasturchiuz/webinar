<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProductSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'category_id') ?>

    <?= $form->field($model, 'profile_id') ?>

    <?= $form->field($model, 'amount') ?>

    <?= $form->field($model, 'related_products') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'code') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'price_protsent') ?>

    <?php // echo $form->field($model, 'text') ?>

    <?php // echo $form->field($model, 'short_text') ?>

    <?php // echo $form->field($model, 'is_new') ?>

    <?php // echo $form->field($model, 'is_popular') ?>

    <?php // echo $form->field($model, 'feature_image') ?>

    <?php // echo $form->field($model, 'available') ?>

    <?php // echo $form->field($model, 'sort') ?>

    <?php // echo $form->field($model, 'slug') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
