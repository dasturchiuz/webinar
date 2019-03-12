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
                        <a href="/account/signup-user" class="btn btn-primary">Я физическое лицо</a>
                        <a href="/account/signup-company" class="btn btn-primary">Я представитель Юридического лица</a>
                    </article> <!-- card-body end .// -->
                    <div class="border-top card-body text-center">Have an account? <a href="<?=yii\helpers\Url::toRoute('account/login');?>">Войти</a></div>
                </div> <!-- card.// -->

            </div>



        </div>
    </div>
</div>
