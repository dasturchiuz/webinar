<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use kartik\date\DatePicker;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\administration\models\EmployeesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Оплата от клеинта';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employees-index">

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            <span class="label label-primary pull-right"><i class="fa fa-html5"></i></span>
        </div><!-- /.box-header -->
        <div class="box-body" id="datagridvie">
            <?php
            $arr=[
                'Январь',
                'Февраль',
                'Март',
                'Апрель',
                'Май',
                'Июнь',
                'Июль',
                'Август',
                'Сентябрь',
                'Октябрь',
                'Ноябрь',
                'Декабрь'
            ];
            ?>
            <?=\yii\grid\GridView::widget([
                'dataProvider'=>$dataProvider,
                'layout'=>"  \n<div class='pull-left'> {summary}</div> \n {items} {pager}",
                'emptyText'=>'Платежей не найдено',
                'summary'=>"<div class='pull-right'>".Yii::t('app', "История платежей")." {begin} - {end} ".Yii::t('app', "из")." {totalCount} </div>",
                'columns'=>[
                    //'id',
                    ['class'=>'yii\grid\SerialColumn'],
                    [
                        'attribute'=>'in_date',
                        'format'=>'raw',
                        'value'=>function($model) use ($arr){
                            return date('d ',strtotime($model->in_date)).$arr[date('n',strtotime( $model->in_date))-1].date(' Y г.', strtotime($model->in_date))."-".date('H:m ',strtotime($model->in_date));
                        }
                    ],
                    [
                        'attribute'=>'pay_id',
                        'format'=>'raw',
                        'value'=>function($model){
                            return $model->pay->pay_name;
                        },
                    ],

                    [
                        'label'=>"Номер заказ",
                        'format'=>'html',
                        'value'=>function($model){
                            return Html::a('№'.$model->order->id, ['/administration/history-order/order-view', 'profile_id'=>$model->order->user_id, 'order_id'=>$model->order->id]);
                        }
                    ],
//                    [
//                        'attribute'=>'created_by',
//                        'format'=>'raw',
//                        'value'=>function($model){
//                            return $model->created_by;// != 0 ? $model->createdBy->fullnameemp."(".$model->createdBy->usernameid.")" : "";
//                        },
//                    ],
                    [
                        'attribute'=>'amount',
                        'format'=>'html',
                        'value'=>function($model){
                            if($model->status==1)
                                return "<span style='color:#20c997;'>".number_format($model->amount, 2, ',', ' ')." сум</span>";
                            else
                                return "<span style='color:#fb010b;'>".number_format($model->amount, 2, ',', ' ')." сум</span>";
                        }
                    ],
                    'in_desc',
                    [
                        'attribute'=>'status',
                        'format'=>'raw',
                        'value'=>function($data){
                            return $data->status==1 ? "<a class='btn btn-success'><span class='glyphicon glyphicon-ok'></span> Оплачен</a>" :  "<a class='btn btn-danger'><span class='glyphicon glyphicon-remove'></span> Отменен</a>" ;
                        }
                    ]
                ]
            ])?>

        </div><!-- /.box-body -->
    </div><!-- /.box -->


</div>