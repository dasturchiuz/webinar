<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\administration\models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

if($client=='client')
$this->title ="Принятые заказы от физических лиц ";
if($client=='client_juridical')
    $this->title ="Принятые заказы от юридических лиц";
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="orders-index">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            <span class="label label-primary pull-right"><i class="fa fa-html5"></i></span>
        </div><!-- /.box-header -->
        <div class="box-body">

            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
            <?php if($client=='client_juridical'):?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
                'layout'=>"  \n<div class='pull-left'> {summary}</div> \n {items} {pager}",
                'emptyText'=>'Результатов не найдено',
                'summary'=>"<div class='pull-right'>".Yii::t('app', "Клиенты")." {begin} - {end} ".Yii::t('app', "из")." {totalCount} </div>",

                //'options'=>['style' => 'white-space:nowrap;'],
                'columns' => [
                    //['class' => 'yii\grid\SerialColumn'],
                    [
                        'label'=>'ID',
                        'attribute'=>'username',
                        'format'=>'html',
                        'value'=>function($model){
                            return Html::a($model->user->user_id, ['/administration/clientjuridical/client-info', 'id'=>$model->user_id]);
                        }
                    ],
                    [
                        'label'=>'Виды деятельности',
                        'format'=>'raw',
                        'value'=>function($model){
                            return isset($model->juridical->statusshopp->name) ? $model->juridical->statusshopp->name : 'nomsiz' ;
                        }
                    ],
                    [
                        'label'=>'Орг-ция',
                        'format'=>'raw',
                        'value'=>function($model){
                            return isset($model->juridical->orgon->name) ? $model->juridical->orgon->name : 'nomsiz';
                        }
                    ],
                    [
                        'label'=>'Число заказа',
                        'format'=>'html',
                        'value'=>function($model){
                            return isset($model->order_date) ? $model->order_date : 'Без время';
                        }
                    ],
                    [
                        'label'=>'Название Организации',
                        'format'=>'html',
                        'value'=>function($model){
                            return isset($model->juridical->tashkilot) ? $model->juridical->tashkilot : 'nomsiz';
                        }
                    ],[
                        'label'=>'Имя пользователя',
                        'format'=>'raw',
                        'value'=>function($model){
                            return isset($model->name_magazin) ? $model->name_magazin : 'nomsiz';
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
            <?php endif; if($client=='client'):?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    //'filterModel' => $searchModel,
                    'layout'=>"  \n<div class='pull-left'> {summary}</div> \n {items} {pager}",
                    'emptyText'=>'Результатов не найдено',
                    'summary'=>"<div class='pull-right'>".Yii::t('app', "Клиенты")." {begin} - {end} ".Yii::t('app', "из")." {totalCount} </div>",

                    //'options'=>['style' => 'white-space:nowrap;'],
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        [
                            'label'=>'ID',
                            'attribute'=>'username',
                            'format'=>'html',
                            'value'=>function($model){
                                return Html::a($model->user->user_id, ['/administration/client/client-info', 'id'=>$model->user_id]);
                            }
                        ],[
                            'label'=>'Имя пользователя',
                            'format'=>'raw',
                            'value'=>function($model){
                                return $model->name_magazin;
                            }
                        ],
                        [
                            'label'=>'Число заказа',
                            'format'=>'html',
                            'value'=>function($model){
                                return isset($model->order_date) ? $model->order_date : 'Без время';
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
                            'format'=>'raw',
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


            <?php endif;?>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</div>
