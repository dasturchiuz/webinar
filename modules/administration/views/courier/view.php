<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Profile */

$this->title = $model->fullnameemp;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Курьеры'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-view">
<div class="row">
    <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Основная</h3>
                <span class="label label-primary pull-right"><i class="fa fa-html5"></i></span>
            </div><!-- /.box-header -->
            <div class="box-body">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'firstname',
                        'lastname',
                        'fathername',
                        'tell',
                        'adress',
                    ],
                ]) ?>

            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Статус </h3>
                <span class="label label-primary pull-right"><i class="fa fa-html5"></i></span>
            </div><!-- /.box-header -->
            <div class="box-body">

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        [
                            'attribute'=> 'user_id',
                            'format'=>'html',
                            'value'=>function($data){
                                return $data->user->username;
                            }
                        ],

                        [
                            'attribute'=> 'role',
                            'format'=>'raw',
                            'value'=>function($model){
                                return $model->getRolename($model->role);
                            }
                        ],
                        [
                            'attribute'=> 'status',
                            'format'=>'raw',
                            'value'=>function($model){
                                return $model->user->statuses[$model->status];
                            }
                        ],

                        'created_at:datetime',
                        'updated_at:datetime',
                    ],
                ]) ?>

            </div>
        </div>
    </div>
<div class="col-md-4">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Действий</h3>
                <span class="label label-primary pull-right"><i class="fa fa-html5"></i></span>
            </div><!-- /.box-header -->
            <div class="box-body">
                <p>
                    <?= Html::a(Yii::t('app', 'Редактировать'), ['update', 'id' => $model->user_id], ['class' => 'btn btn-primary']) ?>

                </p><?php if(\app\models\config\Ruxsatnoma::isHuquqSuperAndAdmin()):?>
                    <p>
                        <?= Html::a(Yii::t('app', 'Изменить пароль'), ['/administration/account/changeuser', 'id' => $model->user_id], ['class' => 'form-control btn btn-primary']) ?>
                    </p>
                <?php endif;?>
                <p><?= Html::a(Yii::t('app', $model->user->status==\app\models\User::STATUS_BLOCKED ? "Уже в списке" : 'Поставить в чёрный' ), [$model->user->status==\app\models\User::STATUS_BLOCKED ?  '/administration/regmanager/un-black-list' : '/administration/regmanager/black-list', 'profile_id'=>$model->user_id], ['class' => 'form-control blacklist btn btn-primary']) ?></p>




            </div>
        </div>
    </div>

</div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        Привязанные Клиенты
                    </h3>
                    <span class="label label-primary pull-right"><i class="fa fa-html5"></i></span>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <p class="pull-right">
                        <?= Html::a('Добавить заказ', ['#'], ['class' => 'btn btn-primary', 'id'=>'addtoorder']) ?>
                    </p>
                    <?= GridView::widget([
                        'dataProvider' => $dataAgentClients,
                        //'filterModel' => $searchModel,
                        'layout'=>"  \n<div class='pull-left'> {summary}</div> \n {items} {pager}",
                        'emptyText'=>'Результатов не найдено',
                        'summary'=>"<div class='pull-right'>".Yii::t('app', "Клиенты")." {begin} - {end} ".Yii::t('app', "из")." {totalCount} </div>",
                        'rowOptions'=>function($model){
                            if($model->getIsnocustomer(Yii::$app->user->getId()))
                                return ['class'=>'danger'];

                        },
                        //'options'=>['style' => 'white-space:nowrap;'],
                        'columns' => [
                            //['class' => 'yii\grid\SerialColumn'],
                            ['class' => 'yii\grid\CheckboxColumn'],
                            [
                                'label'=>'День недели',
                                'format'=>'html',
                                'value'=>function($data){
                                    return \app\models\WeeksName::weeks()[$data->weeks[0]->week_number];
                                }
                            ],
                            [
                                'label'=>'ID',
                                'attribute'=>'username',
                                'format'=>'html',
                                'value'=>function($model){
                                    return Html::a($model->user->username, [$model->role !='client' ? '/administration/clientjuridical/client-info' : '/administration/client/client-info', 'id'=>$model->user_id]);
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
                </div>

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
            </div>
        </div>
    </div>




</div>
