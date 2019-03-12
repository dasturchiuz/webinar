<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Profile */

$this->title = $model->fullnameemp;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Profiles'), 'url' => ['index']];
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
                        'created_at:datetime',

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
                            'attribute'=> 'username',
                            'format'=>'raw',
                            'value'=>function($model){
                                return $model->user->username;
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
                    <?php if(Yii::$app->user->can('super_admin')):?>
                        <?= Html::a(Yii::t('app', 'Уровень'), ['levelcontrol', 'id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a(Yii::t('app', 'Сообщения'), ['levelcontrol', 'id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a(Yii::t('app', 'Статус'), ['levelcontrol', 'id' => $model->user_id], ['class' => 'btn btn-success pull-right']) ?>
                    <?php endif;?>
                </p>
                <p>
                    <?php if(Yii::$app->user->can('super_admin') || Yii::$app->user->can('admin')):?>
                        <?= Html::a(Yii::t('app', 'Изменить информацию'), ['update', 'id' => $model->user_id], ['class' => 'btn btn-primary']) ?>

                        <?= Html::a(Yii::t('app', 'Изменить пароль'), ['/administration/account/changeuser', 'id' => $model->user_id], ['class' => 'btn btn-info pull-right']) ?>
                    <?php endif;?>
                </p>
                <p>
                    </p>
                <p>

                </p><?= Html::a(Yii::t('app', 'Удалить'), ['delete', 'id' => $model->user_id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => Yii::t('app', 'Вы уверены, что хотите удалить этот элемент?'),
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>



            </div>
        </div>
    </div>

</div>


</div>
