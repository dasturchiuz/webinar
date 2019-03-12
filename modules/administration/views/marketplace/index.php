<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MarketplaceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Торговая площадка');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employees-index">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
                <span class="label label-primary pull-right"><i class="fa fa-html5"></i></span>
            </div><!-- /.box-header -->
            <div class="box-body">
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                <p class="pull-right">
                    <?= Html::a('Добавить торговая площадка', ['create'], ['class' => 'btn btn-success']) ?>
                </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'market_name',
            //'status',
            'created_at',
            //'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>"{view} {update}"

            ],
        ],
    ]); ?>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
</div>