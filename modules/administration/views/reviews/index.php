<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\administration\models\ProductreviewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Отзывы на товары');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="productreviews-index">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            <span class="label label-primary pull-right"><i class="fa fa-html5"></i></span>
        </div><!-- /.box-header -->
        <div class="box-body">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute'=> 'user_id',
                'format'=>'raw',
                'value'=>function($model){
                    return $model->user->lastname.'  '.$model->user->firstname.'('.$model->user->user_id.')' ;
                },
            ],
            [

                'attribute'=> 'product_id',
                'format'=>'html',
                'value'=>function($model){
                    return Html::a(Html::encode($model->product->name), ['/product/'.$model->product->slug]);
                },
            ],

            [
                'attribute' =>'star_rating',
                'format'=>'html',
                'value'=>function($model){
                    return '<div class="stars-wrap">
        <ul class="list-rating">
            <li style="width:'.($model->star_rating*20).'%" class="stars-active">
                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
            </li>
            <li>
                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
            </li>
        </ul>
    </div>';
                },
            ],
            'otziv_text',

            [
                'format'=>'raw',
                'attribute'=>'status',
                'value'=>function($model){
                    return $model->statuses[$model->status];
                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
?>
</div>
</div>
</div>
