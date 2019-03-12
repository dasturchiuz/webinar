<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use kartik\date\DatePicker;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\administration\models\EmployeesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Физических и юридических лиц - Доставлено сегодня';
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
                'layout'=>"  \n<div class='pull-left'> {summary}</div> \n {items} {pager}",
                'emptyText'=>'Результатов не найдено',
                'summary'=>"<div class='pull-right'>".Yii::t('app', "Клиенты")." {begin} - {end} ".Yii::t('app', "из")." {totalCount} </div>",
//                'rowOptions'=>function($model){
//                    //if($model->getIsnocustomer(Yii::$app->user->getId()))
//                        return ['class'=>'danger'];
//
//                },
                //'options'=>['style' => 'white-space:nowrap;'],
                'columns' => [
                    //['class' => 'yii\grid\SerialColumn'],
                   // ['class' => 'yii\grid\CheckboxColumn'],
                    [
                        'attribute'=>'id',
                        'format'=>'html',
                        'value'=>function($model){
                            return Html::a("№".$model->id, ['/administration/history-order/order-view', 'profile_id'=>$model->profile->user_id, 'order_id'=>$model->id]);
                        }

                    ],
                    [
                        'label'=>'ID',
                        'attribute'=>'username',
                        'format'=>'html',
                        'value'=>function($model){
                            return Html::a($model->profile->user->user_id, [$model->profile->role !='client' ? '/administration/clientjuridical/client-info' : '/administration/client/client-info', 'id'=>$model->profile->user_id]);
                        }
                    ],
//                    'order_date',
                    [
                        'label'=>'Сумма',
                        'format'=>'html',
                        'value'=>function($model){
                            return number_format($model->sum, 0, ',', ' '). " сум";
                        }
                    ],
                    [
                        'label'=>'Время доставки',
                        'format'=>'html',
                        'value'=>function($model){
                            return  $model->delivery_date;//gmdate("Y-m-d H:i:s",  $model->ddate)
                        }
                    ],
                    [
                        'label'=>'Статус',
                        'format'=>'html',
                        'value'=>function($model){
                            return $model->profile->role=='client' ? 'Физическое лицо' : 'Юридическое лицо' ;
                        }
                    ]
                    ,[
                        'label'=>'Имя пользователя',
                        'format'=>'raw',
                        'value'=>function($model){
                            return $model->profile->name_magazin;
                        }
                    ],
                    [
                        'label'=>'ФИО',
                        'format'=>'raw',
                        'value'=>function($model){
                            return $model->profile->fullnameemp;
                        }
                    ],
                    [
                        'label'=>'Телефон',
                        'format'=>'raw',
                        'value'=>function($model){
                            return $model->profile->tell;
                        }
                    ],
                    [
                        'label'=>'Адрес',
                        'format'=>'raw',
                        'value'=>function($model){
                            return $model->profile->manzil;
                        }
                    ],[
                        'label'=>'Коментарии',
                        'format'=>'html',
                        'value'=>function($model){
                            return $model->profile->comment;
                        }
                    ],

                    //'created_at',
                    //'updated_at',
                    //'user_id',
                    //'last_activity_time',

                    //['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>

            <?php
            $this->registerJs('
                    var aa;
                    $("input:checkbox").on(\'click\', function() {
                      // in the handler, \'this\' refers to the box clicked on
                       if(aa!=null){
                          aa.attr("class", "");
                         }

                    aa= $(this).parent().parent();
                    $("#zakaznomer").html("<b>Номер заказа:</b> "+$(this).parent().next().text());
                    aa.attr("class", "success");
                      var $box = $(this);
                      if ($box.is(":checked")) {
                        // the name of the box is retrieved using the .attr() method
                        var link="/administration/accepted-order/startorder?profile_id="+$box.val()+"&type_order=1";
                        $("#addtoorder").attr("href", link);
                        $("#dynamicmodel-order_id").attr("value", $box.val());
                        // as it is assumed and expected to be immutable
                        var group = "input:checkbox[name=\'" + $box.attr("name") + "\']";
                        // the checked state of the group/box on the other hand will change
                        // and the current value is retrieved using .prop() method
                        $(group).prop("checked", false);
                        $box.prop("checked", true);

                      } else {
                        $box.prop("checked", false);
                       ;
                      }
                    });
                ');
            ?>
        </div><!-- /.box-body -->
    </div><!-- /.box -->


</div>