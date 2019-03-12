<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cities */

$this->title = Yii::t('app', 'Update Cities: ' . $model->id, [
    'nameAttribute' => '' . $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="cities-update">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            <span class="label label-primary pull-right"><i class="fa fa-html5"></i></span>
        </div><!-- /.box-header -->
        <div class="box-body">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
        </div><!-- /.box-body -->
    </div><!-- /.box -->

</div>
