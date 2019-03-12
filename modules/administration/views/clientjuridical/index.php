<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use dosamigos\multiselect\MultiSelect;


/* @var $this yii\web\View */
/* @var $searchModel app\modules\administration\models\EmployeesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Юридическое лицо';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employees-index">

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            <span class="label label-primary pull-right"><i class="fa fa-html5"></i></span>
        </div><!-- /.box-header -->
        <div class="box-body" id="datagridvie">
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>

            <p class="pull-right">
                <?= Html::a('Добавить заказ', ['#'], ['class' => 'btn btn-primary', 'id'=>'addtoorder']) ?>
                <?= Html::a('Добавить Клиента', ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'layout'=>"  \n<div class='pull-left'> {summary}</div> \n {items} {pager}",
                'emptyText'=>'Результатов не найдено',
                'summary'=>"<div class='pull-right'>".Yii::t('app', "Клиенты")." {begin} - {end} ".Yii::t('app', "из")." {totalCount} </div>",
                'rowOptions'=>function($model){
                    if($model->status==\app\models\User::STATUS_BLOCKED){
                        return ['class'=>'danger'];
                    }
                },
                //'options'=>['style' => 'white-space:nowrap;'],
                'columns' => [
                    //['class' => 'yii\grid\SerialColumn'],
                    ['class' => 'yii\grid\CheckboxColumn'],
                    [
                        'label'=>'ID',
                        'attribute'=>'username',
                        'format'=>'html',
                        'value'=>function($model){
                            return Html::a($model->user->user_id, ['client-info', 'id'=>$model->user_id]);
                        },



                    ],
                    [
                        'label'=>'Виды деятельности',
                        'format'=>'raw',
                        'value'=>function($model){
                            return $model->juridical->statusshopp->name;
                        },
//                        'filter'=> MultiSelect::widget([
//                            'id'=>"multiXX",
//                            "options" => ['multiple'=>"multiple"], // for the actual multiselect
//                            'data' => [ 0 => 'super', 2 => 'natural'], // data as array
//                            'value' => [ 0, 2], // if preselected
//                            'name' => 'multti', // name for the form
//                            "clientOptions" =>
//                                [
//                                    "includeSelectAllOption" => true,
//                                    'numberDisplayed' => 2
//                                ],
//                        ])
                    ],
                    [
                        'label'=>'Орг-ция',
                        'format'=>'raw',
                        'value'=>function($model){
                            return $model->juridical->orgon->name;
                        }
                    ],
                    [
                        'label'=>'Название Организации',
                        'format'=>'html',
                        'value'=>function($model){
                            return $model->juridical->tashkilot;
                        }
                    ],[
                        'label'=>'Имя пользователя',
                        'format'=>'raw',
                        'value'=>function($model){
                            return $model->name_magazin;
                        }
                    ],
                    [
                        'label'=>'ФИО',
                        'format'=>'raw',
                        'value'=>function($model){
                            return $model->fullnameemp;
                        }
                    ],
                    [
                        'label'=>'Телефон',
                        'format'=>'raw',
                        'value'=>function($model){
                            return $model->tell;
                        }
                    ],
                    [
                        'label'=>'Адрес',
                        'format'=>'raw',
                        'value'=>function($model){
                            return $model->manzil;
                        }
                    ],[
                        'label'=>'Коментарии',
                        'format'=>'html',
                        'value'=>function($model){
                            return $model->comment;
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
                    $("input:checkbox").on(\'click\', function() {
                      // in the handler, \'this\' refers to the box clicked on
                      var $box = $(this);
                      if ($box.is(":checked")) {
                        // the name of the box is retrieved using the .attr() method
                        var link="/administration/accepted-order/startorder?profile_id="+$box.val()+"&type_order=1";
                        $("#addtoorder").attr("href", link);
                        // as it is assumed and expected to be immutable
                        var group = "input:checkbox[name=\'" + $box.attr("name") + "\']";
                        // the checked state of the group/box on the other hand will change
                        // and the current value is retrieved using .prop() method
                        $(group).prop("checked", false);
                        $box.prop("checked", true);
                      } else {
                        $box.prop("checked", false);
                      }
                    });
                ');
            ?>
        </div><!-- /.box-body -->
    </div><!-- /.box -->


</div>