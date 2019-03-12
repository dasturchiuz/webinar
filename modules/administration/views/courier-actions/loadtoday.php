<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use kartik\date\DatePicker;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\administration\models\EmployeesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Загрузка товара курьеры - Сегодная';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employees-index">

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            <span class="label label-primary pull-right"><i class="fa fa-html5"></i></span>
        </div><!-- /.box-header -->
        <div class="box-body" id="datagridvie">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
                'layout'=>"  \n {summary} \n {items} {pager}",
                'summary'=>"<div class='pull-right'>".Yii::t('app', "Заказы")." {begin} - {end} ".Yii::t('app', "из")." {totalCount} </div>",
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],



                    [
                        'label'=>"Курьер",
                        'format'=>'html',
                        'value'=>function($model){
                            return $model->week->profile->fullnameemp." (".$model->week->profile->usernameid.")";
                        }
                    ],
                    [
                        'label'=>"Телефон",
                        'format'=>'html',
                        'value'=>function($model){
                            return $model->week->profile->tell;
                        }
                    ],[// $model->user->statuses[$model->status];
                        'label'=>"Курьер статус",
                        'format'=>'html',
                        'value'=>function($model){
                            return $model->profile->user->statuses[$model->profile->status];
                        }
                    ],




                    //'termsofuse',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template'=>'{courier}',
                        'buttons'=>[
                            'courier'=>function($url, $model){
                                return Html::a('Загрузка товара курьеру', ['courier', 'id'=>$model->week->profile->user_id], [
                                    'title' => Yii::t('app', 'Курьер'), 'class'=>'btn btn-primary',
                                ]);
                            }
                        ],
                    ],
                ],
            ]); ?>


        </div><!-- /.box-body -->
    </div><!-- /.box -->


</div>