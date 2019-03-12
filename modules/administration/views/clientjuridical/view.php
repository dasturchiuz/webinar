<?php

use  yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Profile */

$this->title = $model->fullnameemp;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Клиентский юридический'), 'url' => ['index']];
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
                        'user_id',

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
                    <?= Html::a(Yii::t('app', 'Update'), ['edit', 'profile_id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
                   
                </p>



            </div>
        </div>
    </div>

</div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Реквизиты</h3>
                    <span class="label label-primary pull-right"><i class="fa fa-html5"></i></span>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <?=DetailView::widget([
                        'model'=>$model->juridic,
                        'attributes'=>[
                            'tashkilot',
                            'bank',
                            'hisobraqam',
                            'inn',
                            'mfo',
                            'oked',
                            'updated_at:datetime',
                            'created_at:datetime',
                        ]
                    ]);?>

                </div>
            </div>
        </div>
    </div>


</div>
