<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\administration\models\EmployeesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Коментарии для Физических и Юридических лиц';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employees-index">

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            <span class="label label-primary pull-right"><i class="fa fa-html5"></i></span>
        </div><!-- /.box-header -->
        <div class="box-body" id="datagridvie">


            <p class="pull-right">
                <?= Html::a('Добавить заказ', ['#'], ['class' => 'btn btn-primary', 'id'=>'addtoorder']) ?>
            </p>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
                'layout'=>"  \n<div class='pull-left'> {summary}</div> \n {items} {pager}",
                'emptyText'=>'Результатов не найдено',
                'summary'=>"<div class='pull-right'>".Yii::t('app', "Клиенты")." {begin} - {end} ".Yii::t('app', "из")." {totalCount} </div>",

                //'options'=>['style' => 'white-space:nowrap;'],
                'columns' => [
                    //['class' => 'yii\grid\SerialColumn'],
                    ['class' => 'yii\grid\CheckboxColumn'],
                    [
                        'label'=>'ID',
                        'attribute'=>'username',
                        'format'=>'html',
                        'value'=>function($model){
                            return Html::a($model->user->user_id, [$model->role !='client' ? '/administration/clientjuridical/client-info' : '/administration/client/client-info', 'id'=>$model->user_id]);
                        }
                    ],

                    [
                        'label'=>'Статус',
                        'format'=>'html',
                        'value'=>function($model){
                            return $model->role=='client' ? 'Физическое лицо' : 'Юридическое лицо' ;
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