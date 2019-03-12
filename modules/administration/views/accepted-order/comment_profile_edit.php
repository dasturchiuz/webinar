<?php

use  yii\helpers\Html;

use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model app\models\Profile */

$this->title = 'Коментарий';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-view">

    <div class="row">

        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Ред коментарий </h3>
                    <span class="label label-primary pull-right"><i class="fa fa-html5"></i></span>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <?php $form=ActiveForm::begin();?>

                    <?=$form->field($commentProfile, 'com_text')->textArea();?>
                    <p class="pull-left"><?=Html::a('Назад', ['/administration/accepted-order/index', 'profile_id'=>$commentProfile->profile_id], ['class'=>'btn btn-warning'])?></p>
                    <p class="pull-right"><?=Html::submitButton('Ред коментарий', ['class'=>'btn btn-primary'])?></p>
                    <?php ActiveForm::end()?>

                </div>
            </div>
        </div>


    </div>

</div>
