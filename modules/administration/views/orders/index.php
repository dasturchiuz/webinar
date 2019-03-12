<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\administration\models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Заказы');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            <span class="label label-primary pull-right"><i class="fa fa-html5"></i></span>
        </div><!-- /.box-header -->
        <div class="box-body">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'layout'=>"  \n {summary} \n {items} {pager}",
        'summary'=>"<div class='pull-right'>".Yii::t('app', "Заказы")." {begin} - {end} ".Yii::t('app', "из")." {totalCount} </div>",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'format'=>'raw',
                'label'=>'Точка покупки',
                'attribute'=>'region_id',
                'value'=>function($model){
                    return $model->region->name_obl;
                },
            ],

            [
                'attribute'=> 'created_at',
                'format'=>'raw',
                'label'=>'Дата покупки'
            ],
            [
                'format'=>'raw',
                'attribute'=>'custom_dastavkanaimiya',
                'value'=>function($model){
                    return '<strong>'.$model->lastname."</strong><br>".$model->adress;
                },
            ],
            [
                'format'=>'raw',
                'attribute'=>'pay_status',
                'value'=>function($model){
                    return $model->statuses[$model->pay_status];
                },
            ],
            //'updated_at',
            //'qty',
            [
                'attribute'=>'sum',
                'format'=>'raw',
                'value'=>function($model){
                    return number_format($model->sum, 0, ',', ' '). " сум";
                },
            ],
            'phone',
            [
                'format'=>'raw',
                'attribute'=>'courier_id',
                'value'=>function($model){
                    if($model->courier_id!=0)
                        return "<strong>". $model->courier->user_id. $model->courier->lastname." <strong>";
                    else
                        return "Не прикрепленный курьер";
                },
            ],

            //'firstname',
            //'lastname',
            //'adress:ntext',
            //'phone',
            //'email:ntext',
//            'pay_status',
            //'pay_method_name',
            //'pay_method_id',
            //'note:ntext',
            [
                'format'=>'raw',
                'attribute'=>'status',
                'value'=>function($model){
                    return $model->statuses[$model->status];
                },
            ],
            //'termsofuse',
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} {courier}',
                'buttons'=>[
                    'courier'=>function($url, $model){
                        return Html::a('<i class="fa fa-truck"></i>', $url, [
                            'title' => Yii::t('app', 'Курьер'),
                        ]);
                    }
                ],
            ],
        ],
    ]); ?>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</div>
