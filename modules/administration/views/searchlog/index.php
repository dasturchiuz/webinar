<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchLogModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Search Logs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="search-log-index">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            <span class="label label-primary pull-right"><i class="fa fa-html5"></i></span>
        </div><!-- /.box-header -->
        <div class="box-body">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Создать Search Log'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            //'session_id',
            [
                'attribute'=>'user_id',
                'format'=>'html',
                'value'=>function($data){
                    return $data->san;
                    //return \yii\helpers\Html::a($data->user->username, [ '/administration/client/client-info', 'id'=>$model->user_id]);
                }
            ],
            'keyword',
            'ip',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</div>
