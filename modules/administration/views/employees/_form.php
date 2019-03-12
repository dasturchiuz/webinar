<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\administration\models\Employees */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employees-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'username')->textInput() ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <?= $form->field($model, 'password_conf')->passwordInput() ?>
            <?= $form->field($model, 'email')->textInput() ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'fathername')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'role')->dropDownList([
                'super_admin'=>'Супер администратор	',
                'admin'=>'Администратор',
                'manager'=>'Менеджеры',
                'regional_managers'=>'Региональные менеджеры',
                'agent'=>'Агент',
                'сouriers'=>'Курьеры',
                'buxgalter'=>"кабинет бухгалтера"
            ], ['prompt'=>'выберите']) ?>
            <?= $form->field($model, 'region_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Regions::find()->all(), 'id', 'name_obl'), ['prompt'=>'Вибрити']) ?>
            <?= $form->field($model, 'adress')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'tell')->textInput(['maxlength' => true]) ?>
        </div>
    </div>








    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>