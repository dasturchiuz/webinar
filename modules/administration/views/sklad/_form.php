<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\product\Sklad */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sklad-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name_sk')->textInput(['maxlength' => true]) ?>
    <?php if(empty($model->region_id_sk)):?>
    <?= $form->field($model, 'strana_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Strana::find()->asArray()->all(), 'id', 'strana_name'), ['prompt'=>'Выберите страна', 'onchange'=>"$.get('".Url::toRoute('/administration/client/oblastlar')."', {strana_id : $(this).val()}).done(function(data){
                         if(data!='1'){
                            $('#sklad-region_id_sk').html(data);
                         }
                    });"]) ?>
    <?php else:?>
    <?php
        $strana=\app\models\Regions::find()->select("strana_id")->where(['id'=>$model->region_id_sk])->asArray()->one();
        $model->strana_id=$strana['strana_id'];
        //$strana=\app\models\Strana::find()->where()->select()
        ?>
        <?= $form->field($model, 'strana_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Strana::find()->asArray()->all(), 'id', 'strana_name'), ['prompt'=>'Выберите страна', 'onchange'=>"$.get('".Url::toRoute('/administration/client/oblastlar')."', {strana_id : $(this).val()}).done(function(data){
                         if(data!='1'){
                            $('#sklad-region_id_sk').html(data);
                         }
                    });"]) ?>

    <?php endif;?>
    <?php if(empty($model->region_id_sk)):?>
        <?= $form->field($model, 'region_id_sk')->dropDownList([], ['prompt'=>"Выберите область"]) ?>
    <?php else:?>
        <?= $form->field($model, 'region_id_sk')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Regions::find()->where(['strana_id'=>$model->strana_id])->all(), 'id', 'name_obl'), ['prompt'=>"Выберите область"]) ?>
    <?php endif;?>
    <?= $form->field($model, 'adress_sk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone_sk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'responsible_sk')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
