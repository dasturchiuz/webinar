<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\administration\models\EmployeesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Регионал Менеджер';
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
                <?= Html::a('Добавить регионального менеджера', ['create'], ['class' => 'btn btn-success']) ?>
            </p>



            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
                'layout'=>"  \n {summary} \n {items} {pager}",
                'summary'=>"<div>".Yii::t('app', "менеджеры")." {begin} - {end} ".Yii::t('app', "из")." {totalCount} </div>",
                'emptyText'=>'Результатов не найдено',
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'user_id',
                    [
                        'attribute'=>'username',
                        'format'=>'raw',
                        'value'=>function($model){
                            return $model->user->username;
                        }
                    ],
                    'lastname',
                    'firstname',
                    'adress',
                    'tell',
                    [
                        'attribute'=>'region_id',
                        'format'=>'raw',
                        'value'=>function($data){
                            return $data->oblast->name_obl;
                        }

                    ],
                    //'created_at',
                    //'updated_at',
                    //'user_id',
                    //'last_activity_time',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div><!-- /.box-body -->
    </div><!-- /.box -->


</div>