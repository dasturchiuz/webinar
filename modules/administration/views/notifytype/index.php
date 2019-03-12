<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\administration\models\NotifytypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Notify Types');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notify-type-index">

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            <span class="label label-primary pull-right"><i class="fa fa-html5"></i></span>
        </div><!-- /.box-header -->
        <div class="box-body">

        <p>
        <?= Html::a(Yii::t('app', 'Create Notify Type'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'notfy_name',
            'notfy_template',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div><!-- /.box-body -->
</div><!-- /.box -->
</div>