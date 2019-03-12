<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
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
                    <h4 class="card-title text-center mb-4 mt-1">Sign in</h4>
                    <hr>
                    <p class="text-success text-center">Some message goes here</p>
                    <form>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                </div>
                                <?= Html::activeTextInput($model, 'username', ['class' => 'form-control']); ?>
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
                            <?= Html::submitButton('Вход', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                        </div> <!-- form-group// -->
                        <p class="text-center"><a href="#" class="btn">Forgot password?</a></p>
                    </form>
                </article>
            </div> <!-- card.// -->
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
