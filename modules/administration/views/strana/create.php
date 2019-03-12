<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Strana */

$this->title = Yii::t('app', 'Create Strana');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Stranas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="strana-create">

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
