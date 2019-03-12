<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', "АВТОРИЗАЦИЯ");
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <div class="row justify-content-center">
        <div class="col-md-4 align-self-center mt-5 ">

            <div class="card">
                <article class="card-body">
                    <h4 class="card-title text-center mb-4 mt-1"><?=Yii::t('app', "АВТОРИЗАЦИЯ")?></h4>
                    <hr>
                    <?php if(Yii::$app->session->hasFlash('error')):?>
                        <div class="alert alert-danger" role="alert">
                            <strong>Ошибка!</strong> <?=Yii::$app->session->getFlash('error');?>
                        </div>
                    <?php endif;?>
                    <?php if(Yii::$app->session->hasFlash('success')):?>
                        <div class="alert alert-success" role="alert">
                             <?=Yii::$app->session->getFlash('success');?>
                        </div>
                    <?php endif;?>
                    <?php $form = ActiveForm::begin();  $form->errorSummaryCssClass="alert alert-danger loginerror";?>
                    <?= $form->errorSummary($model,['header'=>'<h5 class="alert-heading">Пожалуйста, исправьте следующие ошибки:</h5>']); ?>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                </div>
                                <?= Html::activeTextInput($model, 'username', ['class' => 'form-control', 'autocomplete'=>'off']); ?>
                            </div> <!-- input-group.// -->
                        </div> <!-- form-group// -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                </div>
                                <?= Html::activePasswordInput($model, 'password', ['class' => 'form-control']); ?>
                            </div> <!-- input-group.// -->
                        </div> <!-- form-group// -->
                        <div class="form-group">
                            <?= Html::submitButton(Yii::t('app', "Вход"), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                        </div> <!-- form-group// -->
                    <?php ActiveForm::end();?>
                </article>
            </div> <!-- card.// -->
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
