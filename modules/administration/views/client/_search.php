<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CategorySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-search">
    <div class="row">
        <div class="col-md-3">
            <?php $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
                'class' => 'form-horizontal',
            ]); ?>


            <div class="form-group">
                <?= $form->field($model, 'login')->label('Поиск по ID номеру') ?>
            </div>
            <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
            <?= Html::submitButton(Yii::t('app', 'Поиск '), ['class' => 'btn btn-primary']) ?>

            <?php ActiveForm::end(); ?>
        </div>

    </div>

</div>
