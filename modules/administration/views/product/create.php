<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = Yii::t('app', 'Добавить продукт');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Продукты'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            <span class="label label-primary pull-right"><i class="fa fa-html5"></i></span>
        </div><!-- /.box-header -->
        <div class="box-body">

    <?= $this->render('_form', [
        'model' => $model,
        'modelAttr' => $modelAttr,
        'modelDiscount' => $modelDiscount,
        'autocomplement' => $autocomplement,
        'autocomplementValue' => $autocomplementValue,
    ]) ?>
        </div><!-- /.box-body -->
    </div><!-- /.box -->


</div>
