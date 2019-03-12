<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Productreviews */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Productreviews'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="productreviews-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
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
            'status',
        ],
    ]) ?>

</div>
