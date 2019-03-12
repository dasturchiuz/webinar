<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Profile */

$this->title = Yii::t('app', 'Редактировать: ' . $model->fullnameemp, [
    'nameAttribute' => '' . $model->fullnameemp,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Регионал Менеджер'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fullnameemp, 'url' => ['view', 'id' => $model->user_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Редактировать');
?>
<div class="profile-update">

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            <span class="label label-primary pull-right"><i class="fa fa-html5"></i></span>
        </div><!-- /.box-header -->
        <div class="box-body">

    <?= $this->render('_update', [
        'model' => $model,
    ]) ?>

</div>
</div>
</div>
