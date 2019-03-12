<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\administration\models\EmployeesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Сотрудники';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employees-index">

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            <span class="label label-primary pull-right"><i class="fa fa-html5"></i></span>
        </div><!-- /.box-header -->
        <div class="box-body">
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>

            <p class="pull-right">
                <?= Html::a('Создание сотрудников', ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <?php
            $url = Url::to(['players/index', 'ProfileSearch[user_id]'=>5]);
            $options = [];
            echo Html::a('Edit Players',$url,$options);

            ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'user_id',
                    [
                        'attribute'=>'fullname',
                        'format'=>'raw',
                        'value'=>function($data){
                            return $data->fullnameemp;
                        },
                    ],[
                        'attribute'=>'role',
                        'format'=>'raw',
                        'value'=>function($data){
                            return $data->rolename;
                        },
                    ],
                    //'adress',
                    //'tell',
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