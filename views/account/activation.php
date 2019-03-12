<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', "АВТОРИЗАЦИЯ");
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <?php $form = ActiveForm::begin(); ?>

    <div class="row justify-content-center">
        <div class="col-md-4 align-self-center mt-5 ">

            <div class="card">
                <article class="card-body">
                    <h4 class="card-title text-center mb-4 mt-1"><?=Yii::t('app', "АВТОРИЗАЦИЯ")?></h4>
                    <hr>
                    <?php if(!empty($user)):?>
                        <?php $form = ActiveForm::begin(); ?>

                        <?=$form->field($Activation,  'username')->textInput(['readOnly'=> true, 'value'=>$user->username]);?>

                        <?=$form->field($Activation, 'telefon')->widget(\yii\widgets\MaskedInput::className(), [
                            'mask' => '+999(99)999-9999',
                            'options'=>[
                                'value'=>$Activation->telefon==null ? '+998' : $Activation->telefon ,
                                'class'=>'form-control',
                            ],
                            'clientOptions' => [
                                'autoclear'=>false,
                                'removeMaskOnSubmit' => true,

                            ],
                        ]) ?>
                        <div class="form-group">
                            <p class="text-right">
                                <?= Html::submitButton('Авторизация ', ['class' => 'btn btn-success']) ?>
                            </p>
                        </div>
                        <?=$form->field($Activation,  'auth_key', ['template'=>'{input}'])->hiddenInput(['value'=>$user->auth_key])->label(false);?>

                        <?php ActiveForm::end(); ?>
                    <?php else:?>

                        <p class="text-center"><?=Yii::t('app', "Не существует или активирован?")?></p>
                    <?php endif;?>
                </article>
            </div> <!-- card.// -->
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>



