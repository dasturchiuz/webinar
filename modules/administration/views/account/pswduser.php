<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */

$this->title = "Изменит парол аккаунта";
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Заказы'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-view">


    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?=Html::encode($this->title)?></h3>
            <span class="label label-primary pull-right"><i class="fa fa-html5"></i></span>
        </div><!-- /.box-header -->
        <div class="box-body">

            <?php $form=ActiveForm::begin();?>
            <?php if($model->scenario==\app\models\Passwordchange::SCENARIO_PSWD_USER):?>
                <?=$form->field($model, 'current_pswd')->passwordInput();?>

            <?php endif;?>
            <?=$form->field($model, 'new_pswd_con')->passwordInput();?>
            <?=$form->field($model, 'new_pswd')->passwordInput()?>

            <?=Html::submitButton(Yii::t('app', ' Изменит'), ['class'=>'btn btn-primary']);?>

            <?php ActiveForm::end();?>
        </div><!-- /.box-body -->
    </div><!-- /.box -->

</div>
