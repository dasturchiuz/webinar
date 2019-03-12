<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\administration\models\EmployeesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Кабинет бухгалтеры';
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
                <?= Html::a('Добавить бухгалтер', ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <?php if(Yii::$app->user->can('agent')): ?>
                salom
            <?php endif;?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
                'layout'=>"  \n {summary} \n {items} {pager}",
                'summary'=>"<div>".Yii::t('app', "бухгалтеры")." {begin} - {end} ".Yii::t('app', "из")." {totalCount} </div>",
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

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header'=>'Действий',
                        'template'=>'{update} {view} {delete}',
                        'buttons'=>[
                            'statis'=>function($url, $model){
                                return Html::a('<i class="fa fa-line-chart" aria-hidden="true"></i>', ["/administration/report/clientjuridicalbyid", "user_id"=>$model->user_id], ['title'=>"Юр лицо"]);// '<a href="#"></a>';
                            },
                            'statiscl'=>function($url, $model){
                                return Html::a('<i class="fa fa-line-chart" aria-hidden="true"></i>', ["/administration/report/clientbyid", "user_id"=>$model->user_id], ['title'=>"Физ лицо"]);// '<a href="#"></a>';
                            },

                        ],
                    ],
                ],
            ]); ?>
        </div><!-- /.box-body -->
    </div><!-- /.box -->


</div>