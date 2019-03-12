<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = Yii::t('app', 'Обновить продукт: ' , [
    'nameAttribute' => '' . $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Продукты'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Обновить');
?>
<div class="product-update">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title. $model->name) ?></h3>
            <div class="pull-right"><?php if(!$model->isNewRecord):?>
                    <?=Html::a("Просмотр товара", ['/product/'.$model->slug], ['class'=>'btn btn-primary']  )?>
                <?php endif;?></div>
        </div><!-- /.box-header -->
        <div class="box-body">

    <?= $this->render('_form', [
        'model' => $model,
        'modelAttr' => $modelAttr,
        'modelDiscount' => $modelDiscount,
        'autocomplement' => $autocomplement,
        'autocomplementValue' => $autocomplementValue,
    ]) ?>

        </div>
    </div>
</div>
