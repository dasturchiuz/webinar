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
                        <h4 class="card-title mt-2">Зарегистрироваться</h4>
                    </header>
                    <article class="card-body">
                        <?php if(Yii::$app->session->hasFlash('success')):?>
                        <div class="alert alert-success" role="alert">
                            <?=Yii::$app->session->getFlash('success');?>
                        </div>
                        <?php endif;?>

                        <?php if(Yii::$app->session->hasFlash('error')):?>
                        <div class="alert alert-danger" role="alert">
                            <?=Yii::$app->session->getFlash('error');?>
                        </div>
                        <?php endif;?>

                    </article> <!-- card-body end .// -->
                </div> <!-- card.// -->

            </div>



        </div>
    </div>
</div>
