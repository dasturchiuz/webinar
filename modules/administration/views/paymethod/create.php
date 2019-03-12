<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Paymethod */

$this->title = Yii::t('app', 'Create Paymethod');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Paymethods'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="paymethod-create">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            <span class="label label-primary pull-right"><i class="fa fa-html5"></i></span>
        </div><!-- /.box-header -->
        <div class="box-body">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div><!-- /.box-body -->
</div><!-- /.box -->

</div>
