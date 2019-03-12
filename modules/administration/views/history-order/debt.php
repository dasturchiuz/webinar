<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */

$this->title = "Долг";


$this->params['breadcrumbs'][] = $this->title;
?>
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
<div class="orders-view">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= Html::encode($this->title) ?> </h3>
                    <span class="label label-primary pull-right"><i class="fa fa-info-circle"></i></span>
                </div><!-- /.box-header -->
                <div class="box-body">


                    <?=\yii\grid\GridView::widget([
                        'dataProvider'=>$dataProvider,
                        'layout'=>"  \n<div class='pull-left'> {summary}</div> \n {items} {pager}",
                        'emptyText'=>'Платежей не найдено',
                        'summary'=>"<div class='pull-right'>".Yii::t('app', "История долг")." {begin} - {end} ".Yii::t('app', "из")." {totalCount} </div>",
                        'columns'=>[
                            //'id',
                            ['class'=>'yii\grid\SerialColumn'],
                            [
                                'attribute'=>'repay_date',
                                'format'=>'raw',
                                'value'=>function($model) use ($arr){
                                    return date('d ',strtotime($model->repay_date)).$arr[date('n',strtotime( $model->repay_date))-1].date(' Y г.', strtotime($model->repay_date));
                                }
                            ],[
                                'attribute'=>'created_by',
                                'format'=>'raw',
                                'value'=>function($model){
                                    return $model->createdBy->fullnameemp."(".$model->createdBy->usernameid.")";
                                },
                            ],
                            [
                                'attribute'=>'amount',
                                'format'=>'html',
                                'value'=>function($model){
                                    if($model->status==$model::STATUS_OFF)
                                        return "<span style='color:#20c997;text-decoration: line-through;'>".number_format($model->amount, 2, ',', ' ')." сум</span>";
                                    else
                                        return "<span style='color:#c82333;'>".number_format($model->amount, 2, ',', ' ')." сум</span>";

                                }
                            ],
                            [
                                'attribute'=>'status',
                                'format'=>'html',
                                'value'=>function($model){
                                    if($model::STATUS_NEW==$model->status){
                                        return "Активный долг";
                                    }elseif($model::STATUS_OFF==$model->status){
                                        return "Не активный долг";
                                    }else{
                                        return "Системний ошибка! Сообщат программисту";
                                    }

                                }
                            ],
//                                 'status',
                        ]
                    ])?>




                </div>
            </div>

        </div>
    </div>





</div>
