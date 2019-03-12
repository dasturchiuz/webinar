<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Cities */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cities-form">

    <?php $form = ActiveForm::begin(); ?>



    <?= $form->field($model, 'strana_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Strana::find()->all(), 'id', 'strana_name'),
        [
            'prompt'=>"--Выберите область--",
            'onchange'=>"$.get('".Url::toRoute('/administration/cities/oblastlar')."', {strana_id : $(this).val()}).done(function(data){
                         if(data!='1'){
                            $('#cities-region_id').html(data);
                         }
                    });",
        ]) ?>
    <?= $form->field($model, 'region_id')->dropDownList([], ['prompt'=>"--Выберите область--"]) ?>
    <?= $form->field($model, 'city_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sort_city')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
