<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\administration\models\EmployeesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employees-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="row">
        <div class="col-md-1">
            <?= $form->field($model, 'user_id') ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'lastname') ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'firstname') ?>
        </div>

        <div class="col-md-2">
            <?= $form->field($model, 'role')->dropDownList([
                'super_admin'=>'Супер администратор	',
                'admin'=>'Администратор',
                'buxgalter'=>"кабинет бухгалтера",
                'manager'=>'Менеджеры',
                'regional_managers'=>'Региональные менеджеры',
                'agent'=>'Агент',
                'сouriers'=>'Курьеры',
            ], ['prompt'=>'выберите']) ?>
        </div>












        <?php // echo $form->field($model, 'adress') ?>

        <?php // echo $form->field($model, 'tell') ?>

        <?php // echo $form->field($model, 'created_at') ?>

        <?php // echo $form->field($model, 'updated_at') ?>

        <?php // echo $form->field($model, 'user_id') ?>

        <?php // echo $form->field($model, 'last_activity_time') ?>

    </div>


    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>