<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\administration\models\EmployeesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Физических и юридических лиц';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employees-index">

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            <span class="label label-primary pull-right"><i class="fa fa-html5"></i></span>
        </div><!-- /.box-header -->
        <div class="box-body" id="datagridvie">
            <?php $form=ActiveForm::begin();?>

            <?=$form->field($comment, 'com_text')->textArea();?>

            <p class="pull-right"><?=Html::submitButton('Добавить коментарий', ['class'=>'btn btn-primary'])?></p>
            <?php ActiveForm::end()?>


        </div><!-- /.box-body -->
    </div><!-- /.box -->


</div>