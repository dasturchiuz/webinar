<?php

use  yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model app\models\Profile */

$this->title = "Принять заказ";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-view">
    <div class="row">
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Праверка ID</h3>
                </div><!-- /.box-header -->
                <div class="box-body">

                    <?php $form=ActiveForm::begin();?>
                    <div class="row">

                        <div class="col-md-8">
                            <?=$form->field($model, 'user_id')->textInput()->label(false);?>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <?= Html::submitButton('Проверить', ['class' => 'btn btn-primary']) ?>
                            </div>
                        </div>

                    </div>


                    <?php ActiveForm::end();?>

                </div>
            </div>
            <?php if(!empty($client)):?>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Действий</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <p>
                            <?= Html::a(Yii::t('app', 'Принять заказ'), ['startorder', 'profile_id' => $client->user_id, 'type_order'=>1], ['class' => 'form-control btn btn-primary']) ?>
                        </p>
                        <?php  if(Yii::$app->session->has('profile_id') && Yii::$app->session->get('profile_id')==$client->user_id ):?>
                            <?= Html::a(Yii::t('app', 'Удалить из принять заказ'), ['removeorder', 'profile_id' => $client->user_id, 'type_order'=>1], ['class' => 'form-control btn btn-danger']) ?>
                        <?php endif;?>

                    </div>
                </div>
            <?php endif;?>

        </div>

        <?php if(!empty($client)):?>
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">ФИО - учредителя</h3>
                    <span class="label label-primary pull-right"><i class="fa fa-html5"></i></span>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <?= DetailView::widget([
                        'model' => $client,
                        'attributes' => [

                            'lastname',
                            'firstname',
                            'fathername',
                            'tell',
                            'email',
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
                        'model' => $client,
                        'attributes' => [
                            [
                                'label'=>'ID',
                                'attribute'=>'username',
                                'format'=>'html',
                                'value'=>function($model){
                                    return Html::a($model->user->user_id, ['client-info', 'id'=>$model->user_id]);
                                }
                            ],

                            [
                                'label'=>'Имя пользователя',
                                'attribute'=> 'name_magazin',
                                'format'=>'html',
                                'value'=>function($model){
                                    return "<strong style='color: red;'>".$model->name_magazin."</strong>";
                                }
                            ],[
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
                            'vipstatus',
                            'created_at:datetime',
                        ],
                    ]) ?>

                </div>
            </div>
        </div>





    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Коментарии </h3>
                    <span class="label label-primary pull-right"><i class="fa fa-commenting"></i></span>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <?=ListView::widget([
                        'dataProvider'=>$comments,
                        'layout'=>'{items}',
                        'itemView'=>'_comment_prinyat',
                    ])?>

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Адрес организации:</h3>
                    <span class="label label-primary pull-right"><i class="fa fa-address-book-o"></i></span>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <?=DetailView::widget([
                        'model'=>$client->adresess,
                        'attributes'=>[
                            [
                                'attribute'=>'strana_id',
                                'format'=>'raw',
                                'value'=>function($model){
                                    return $model->strana->strana_name;
                                }
                            ],[
                                'attribute'=>'oblast_id',
                                'format'=>'raw',
                                'value'=>function($model){
                                    return $model->oblast->name_obl;
                                }
                            ],[
                                'attribute'=>'city_id',
                                'format'=>'raw',
                                'value'=>function($model){
                                    return $model->city->city_name;
                                }
                            ],
                            'pochta_index',
                            'street',
                            'house',
                            'room',
                            'orientir',
                        ]
                    ]);?>

                </div>
            </div>
        </div>
    </div>

    <?php endif;?>


</div>
