<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\administration\models\ManufacturerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'производители');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manufacturer-index">

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            <span class="label label-primary pull-right"><i class="fa fa-html5"></i></span>
        </div><!-- /.box-header -->
        <div class="box-body">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Добавить производителя'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            //'code',
            [
                'attribute'=>'img_logo',
                'format'=>'raw',
//                'value'=>function($data){
//
//                    return $data->feature_image;
//                },
                'value' => function ($data) {
                    return '<div class="text-center">'. Html::img(Yii::getAlias('@web'). $data->img_logo,
                        ['width' => '150px']).'</div>';
                },
            ],

            //'desc:ntext',
            //'slug',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div><!-- /.box-body -->
</div><!-- /.box -->
</div>
