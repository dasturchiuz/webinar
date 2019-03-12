<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\product\Sklad */

$this->title = $model->name_sk;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Склад'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sklad-view">

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
    <p>
        <?= Html::a(Yii::t('app', 'Редактировать'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Удалить'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Вы уверены, что хотите удалить этот элемент?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name_sk',
            [
                'attribute'=>'region_id_sk',
                'format'=>'raw',
                'value'=>function($model){
                    return \app\models\Regions::findOne($model->region_id_sk)->name_obl;
                }
            ],
            'adress_sk',
            'phone_sk',
            'responsible_sk',
        ],
    ]) ?>

</div>
</div>
</div>
