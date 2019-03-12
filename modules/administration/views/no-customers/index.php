<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\administration\models\EmployeesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Территория физических и юридических лиц';
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

                'columns'=>[
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute'=>'comment_id',
                        'format'=>'html',
                        'value'=>function($model){
                            return $model->comment;
                        }
                    ],
                    'created_at:datetime',
                    [
                        'attribute'=>'created_by',
                        'format'=>'html',
                        'value'=>function($model){
                            return Html::a($model->created->user->username, ['/administration/'.$model->created->role=='client' ? 'client' : 'clientjuridical'.'/client-info', 'id'=>$model->created->user->id]);
                        }
                    ],
                    [
                        'attribute'=>'status',
                        'format'=>'html',
                        'value'=>function($model){
                            if($model->status==1)
                            {
                                return "Заказчика не было";
                            }else{
                                return "Заказчик не купил";
                            }

                        }
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{delete}',
                        'buttons' => [
                            'delete' => function ($url, $model) {
                                return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                    'title' => Yii::t('app', 'удалить эти данные'),
                                    'data'=>[
                                        'method' => 'post',
                                        'confirm' => 'Вы действительно хотите удалить эти данные',
                                    ]
                                ]);
                            },
                        ]
                    ],

                ]
               
            ]); ?>

        </div><!-- /.box-body -->
    </div><!-- /.box -->


</div>