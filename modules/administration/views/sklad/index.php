<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\product\SkladSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Sklads');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sklad-index">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            <span class="label label-primary pull-right"><i class="fa fa-html5"></i></span>
        </div><!-- /.box-header -->
        <div class="box-body">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Создать Sklad'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

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
            //'responsible_sk',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</div>
