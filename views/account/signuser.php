<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\MaskedInput;
use app\models\Regions;
use app\models\Cities;
$this->title = 'Создать учётную запись';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <header class="card-header">
                        <h4 class="card-title mt-2">Регистрация для физического лица</h4>
                    </header>
                    <article class="card-body">

                            <?php $form = ActiveForm::begin(); ?>


                            <div class="row">
                                <div class="col-md-12">
                                    <h3>ФИО </h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <?=$form->field($registration, 'familiya')->textInput() ?>
                                </div>
                                <div class="col-md-4">
                                    <?=$form->field($registration, 'ism')->textInput() ?>
                                </div>
                                <div class="col-md-4">
                                    <?=$form->field($registration, 'otasiningismi')->textInput() ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <?=$form->field($registration, 'telefon')->widget(\yii\widgets\MaskedInput::className(), [
                                        'mask' => '+999(99)999-9999',
                                        'options'=>[
                                            'value'=>$registration->telefon==null ? '+998' : $registration->telefon ,
                                            'class'=>'form-control',
                                        ],
                                        'clientOptions' => [
                                            'autoclear'=>false,
                                            'removeMaskOnSubmit' => true,

                                        ],
                                    ]) ?>

                                </div>
                                <div class="col-md-3">
                                    <?=$form->field($registration, 'email')->widget(\yii\widgets\MaskedInput::className(), [
                                        'clientOptions' => [
                                            'alias' =>  'email',

                                        ],

                                    ]) ?>
                                </div>
                                <div class="col-md-3">
                                    <br>
                                    <p>
                                        <?php //=$form->field($registration, 'main_fio')->radio([ 'value' => 1, 'uncheck' => null])  ?>
                                    </p>
                                    <br>

                                    <p>
                                        <?php //=$form->field($registration, 'main_fio')->radio([ 'value' => 1, 'uncheck' => null])  ?>
                                    </p>


                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Адрес:</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">

                                    <?=$form->field($registration, 'strana')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Strana::find()->all(), 'id', 'strana_name'),
                                        [
                                            'prompt'=>'Выберите',
                                            'onchange'=>"$.get('".Url::toRoute('/account/oblastlar')."', {strana_id : $(this).val()}).done(function(data){
                         if(data!='1'){
                            $('#regfiz-oblast').html(data);
                         }
                    });",
                                        ]
                                    )?>
                                </div>
                                <div class="col-md-3">
                                    <?php if($registration->strana!=null):?>
                                        <?=$form->field($registration, 'oblast')->dropDownList(ArrayHelper::map(Regions::find()->where(['strana_id'=>$registration->strana])->asArray()->all(), 'id', 'name_obl'),
                                            [
                                                'prompt'=>'Выберите',
                                                'onchange'=>"$.get('".Url::toRoute('/account/shaharlar')."', {region_id : $(this).val()}).done(function(data){
                         if(data!='1'){
                            $('#regfiz-gorod').html(data);
                         }
                    });",
                                            ]
                                        ) ?>
                                    <?php else: ?>
                                        <?=$form->field($registration, 'oblast')->dropDownList([],
                                            [
                                                'prompt'=>'Выберите',
                                                'onchange'=>"$.get('".Url::toRoute('/account/shaharlar')."', {region_id : $(this).val()}).done(function(data){
                         if(data!='1'){
                            $('#regfiz-gorod').html(data);
                         }
                    });",
                                            ]
                                        ) ?>
                                    <?php endif;?>

                                </div>
                                <div class="col-md-3">
                                    <?php if($registration->oblast!=null):?>
                                        <?=$form->field($registration, 'gorod')->dropDownList(ArrayHelper::map(Cities::find()->where(['region_id'=>$registration->oblast])->asArray()->all(), 'id', 'city_name'), ['prompt'=>'Выберите'])?>
                                    <?php else: ?>
                                        <?=$form->field($registration, 'gorod')->dropDownList([], ['prompt'=>'Выберите'])?>
                                    <?php endif;?>

                                </div>
                                <div class="col-md-3">
                                    <?=$form->field($registration, 'index')->textInput() ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2">
                                    <?=$form->field($registration, 'ulitsa')->textInput()?>
                                </div>
                                <div class="col-md-2">
                                    <?=$form->field($registration, 'dom')->textInput()?>
                                </div>
                                <div class="col-md-2">
                                    <?=$form->field($registration, 'kvartera')->textInput()?>
                                </div>

                                <div class="col-md-6">
                                    <?=$form->field($registration, 'orenter')->textArea()?>
                                </div>

                            </div>



                            <div class="row">
                                <div class="col-md-8">
                                    <?=$form->field($registration, 'desc_comment')->textArea()?>
                                </div>


                            </div>




                            <div class="form-group">
                                <p class="text-right">
                                    <?= Html::submitButton('Регистрация ', ['class' => 'btn btn-success']) ?>
                                </p>
                            </div>

                            <?php ActiveForm::end(); ?>


                    </article> <!-- card-body end .// -->
                    <div class="border-top card-body text-center">Have an account? <a href="<?=yii\helpers\Url::toRoute('account/login');?>">Войти</a></div>
                </div> <!-- card.// -->

            </div>



        </div>
    </div>
</div>
