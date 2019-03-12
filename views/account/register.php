<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Создать учётную запись';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <header class="card-header">
                        <a href="<?=yii\helpers\Url::toRoute('account/login');?>" class="float-right btn btn-outline-primary mt-1">Войти</a>
                        <h4 class="card-title mt-2">Зарегистрироваться</h4>
                    </header>
                    <article class="card-body">

                        <?php $form =ActiveForm::begin(['enableAjaxValidation' => true]);//?>
                        <div class="row">
                            <div class="col-8">
                                <?=$form->field($Registration, 'is_juridical')->dropDownList([
                                    '0'=>'Я физическое лицо',
                                    '1'=>'Я представитель Юридического лица',
                                ],
                                    [
                                        'options' =>
                                            [
                                                '0' => ['Selected'=>'selected'],
                                            ],
                                        'class'=>'form-control isjur',
                                    ]);?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <?=$form->field($Registration, 'email')->textInput(['class'=>'col form-control']);?>

                                    <?=$form->field($Registration, 'password')->passwordInput(['class'=>'col form-control']);?>

                                    <?=$form->field($Registration, 'password_conf')->passwordInput(['class'=>'col form-control']);?>
                                </div>

                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <?=$form->field($Registration, 'firstname')->textInput(['class'=>'col form-control']);?>

                                    <?=$form->field($Registration, 'lastname')->textInput(['class'=>'col form-control']);?>
                                    <?=$form->field($Registration, 'fathername')->textInput(['class'=>'col form-control']);?>
                                </div>

                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <?=$form->field($Registration, 'tell')->textInput(['class'=>'col form-control']);?>
                                    <?=$form->field($Registration, 'region_id')->dropDownList(yii\helpers\ArrayHelper::map(\app\models\Regions::find()->asArray()->all(), 'id', 'name_obl'), ['prompt'=>'Выбрать ...']);?>
                                    <?=$form->field($Registration, 'adress')->textInput(['class'=>'col form-control']);?>
                                </div>

                            </div>

                        </div>
                        <div id="juridical" style="display: none;">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <?=$form->field($Registration, 'tashkilot')->textInput(['class'=>'col form-control']);?>

                                        <?=$form->field($Registration, 'bank')->textInput(['class'=>'col form-control']);?>


                                    </div>

                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <?=$form->field($Registration, 'hisobraqam')->textInput(['class'=>'col form-control']);?>
                                        <?=$form->field($Registration, 'oked')->textInput(['class'=>'col form-control']);?>


                                    </div>

                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <?=$form->field($Registration, 'inn')->textInput(['class'=>'col form-control']);?>
                                        <?=$form->field($Registration, 'mfo')->textInput(['class'=>'col form-control']);?>
                                    </div>

                                </div>

                            </div>
                        </div>

                        <div class="form-group float-right">
                            <?= Html::submitButton('Зарегистрироваться', ['class'=>'btn btn-success'])?>
                        </div>




                        <?php

                            $this->registerJs("
                                $(function(){
                                    $('.isjur').change(function(){
                                        if($(this).val()==1){
                                            $('#juridical').show();
                                        }else{
                                            $('#juridical').hide();
                                        }
                                    });


                               });");
                        ?>


                        <?php ActiveForm::end(); ?>
                    </article> <!-- card-body end .// -->
                    <div class="border-top card-body text-center">Have an account? <a href="<?=yii\helpers\Url::toRoute('account/login');?>">Войти</a></div>
                </div> <!-- card.// -->

            </div>



        </div>
    </div>
</div>
