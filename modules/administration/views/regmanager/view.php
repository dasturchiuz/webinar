<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Profile */

$this->title = $model->fullnameemp;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Регионал Менеджер'), 'url' => ['index']];
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
                            'format'=>'html',
                            'value'=>function($model){
                                return '<p style="color: green;">'.$model->user->statuses[$model->status].'</p>';
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

                </p>
                <?php if(\app\models\config\Ruxsatnoma::isHuquqSuperAndAdmin()):?>
                    <p>
                        <?= Html::a(Yii::t('app', 'Изменить пароль'), ['/administration/account/changeuser', 'id' => $model->user_id], ['class' => 'form-control btn btn-primary']) ?>
                    </p>
                <?php endif;?>
                <p><?= Html::a(Yii::t('app', $model->user->status==\app\models\User::STATUS_BLOCKED ? "Уже в списке" : 'Поставить в чёрный' ), [$model->user->status==\app\models\User::STATUS_BLOCKED ?  '/administration/regmanager/un-black-list' : '/administration/regmanager/black-list', 'profile_id'=>$model->user_id], ['class' => 'form-control blacklist btn btn-primary']) ?></p>




            </div>
        </div>
    </div>

</div>


</div>
