<?php

use  yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Profile */

    $this->title = $model->user->user_id." - ".$model->fullnameemp;


$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Физическое лицо'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-view">
    <div class="row">
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">ФИО - учредителя</h3>
                    <span class="label label-primary pull-right"><i class="fa fa-html5"></i></span>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [

                            'lastname',
                            'firstname',
                            'fathername',
                            'tell',
                            [
                                'attribute'=>'email',
                                'format'=>'html',
                                'value'=>function($model){
                                    return $model->user->email;
                                }
                            ],
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
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Действий</h3>
                    <span class="label label-primary pull-right"><i class="fa fa-html5"></i></span>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="col-md-6">
                       
                        <p>
                            <?= Html::a(Yii::t('app', 'История покупок'), ['/administration/history-order/purchase-history', 'profile_id' => $model->user_id], ['class' => 'form-control btn btn-primary']) ?>
                        </p>
                        <p>
                            <?= Html::a(Yii::t('app', 'Коментарии | '.$model->commentin ), ['/administration/clientjuridical/comment-profile', 'profile_id'=>$model->user_id], ['class' => 'form-control btn btn-warning']) ?>
                        </p>

                        <p>
                            <?= Html::a(Yii::t('app', $model->user->status==\app\models\User::STATUS_BLOCKED ? "Уже в списке" : 'Поставить в чёрный' ), [$model->user->status==\app\models\User::STATUS_BLOCKED ?  '/administration/clientjuridical/un-black-list' : '/administration/clientjuridical/black-list', 'profile_id'=>$model->user_id], ['class' => 'form-control blacklist btn btn-primary']) ?>
                        </p>
                        <?php if(\app\models\config\Ruxsatnoma::isHuquqRahbariyat() || Yii::$app->user->can('super_admin')):?>
                            <p>
                                <?= Html::a(Yii::t('app', 'Привязать к агенту'), ['setagent', 'id' => $model->user_id], ['class' => 'form-control btn btn-primary']) ?>
                            </p>
                        <?php endif;?>
                        <?php if(Yii::$app->user->can('super_admin')):?>
                            <p>
                                <?= Html::a(Yii::t('app', 'Сообщении'), ['messages', 'user_id' => $model->user_id], ['class' => 'form-control btn btn-primary']) ?>
                            </p>
                        <?php endif;?>
                    </div>
                    <div class="col-md-6">
                        <p>
                            <?= Html::a(Yii::t('app', 'История заказов'), ['/administration/history-order/client', 'profile_id' => $model->user_id], ['class' => 'form-control btn btn-success fiolet']) ?>
                        </p>

                        <p>
                            <?= Html::a(Yii::t('app', 'Редактировать ' ), ['/administration/client/edit', 'profile_id'=>$model->user_id], ['class' => 'form-control btn btn-warning']) ?>
                        </p>
                        <p>
                            <?= Html::a(Yii::t('app', 'Кредитная история'), ['/administration/history-order/credit-history', 'profile_id' => $model->user_id],['class' => 'form-control btn btn-info']) ?>
                        </p><p>
                            <?= Html::a(Yii::t('app', 'Предоплата'), ['/administration/history-order/prepayment-history', 'profile_id' => $model->user_id], ['class' => 'form-control btn btn-success']) ?>
                        </p>

                        <?php if(\app\models\config\Ruxsatnoma::isHuquqRahbariyat() || Yii::$app->user->can('super_admin')):?>
                            <p>
                                <?= Html::a(Yii::t('app', 'Привязать к курьер'), ['setcourier', 'id' => $model->user_id], ['class' => 'form-control btn btn-primary']) ?>
                            </p>
                        <?php endif;?>
                        <?php if(\app\models\config\Ruxsatnoma::isHuquqSuperAndAdmin() ):?>
                            <p>
                                <?= Html::a(Yii::t('app', 'Изменить пароль'), ['/administration/account/changeuser', 'id' => $model->user_id], ['class' => 'form-control btn btn-primary']) ?>
                            </p>
                        <?php endif;?>

                    </div>






                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Привязанный агент</h3>
                    <span class="label label-primary pull-right"><i class="fa fa-html5"></i></span>
                </div><!-- /.box-header -->
                <div class="box-body">

                    <?php if(!empty($model->agent)):?>

                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <td><strong>Логин:</strong> </td>
                                <td><?=$model->agent->user->usernameid?></td>
                                <td><strong>Статус:</strong></td>
                                <td>Активный</td>
                            </tr>
                            <tr>
                                <td><strong>Ф.И.О:</strong> </td>
                                <td><?=$model->agent->user->fullnameemp?></td>
                                <td><strong>Област:</strong></td>
                                <td><?=$model->agent->user->oblast->name_obl?></td>
                            </tr>
                            <tr>
                                <td><strong>Дни недели:</strong> </td>
                                <td style="color:#FF0000;"><?=\app\models\WeeksName::weeks()[$model->agent->week_number]?></td>
                                <td><strong>Привязан в:</strong></td>
                                <td><?=$model->agent->created->fullnameemp?></td>

                            </tr>


                            </tbody>
                        </table>
                    <?php else: ?>
                        <p class="text-center">
                            <i class="fa fa-exclamation-triangle fa-5x" aria-hidden="true"></i>
                        </p>
                    <?php endif;?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Привязанный курьер</h3>
                    <span class="label label-primary pull-right"><i class="fa fa-html5"></i></span>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <?php if(!empty($model->courier)):?>

                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <td><strong>Логин:</strong> </td>
                                <td><?=$model->courier->user->usernameid?></td>
                                <td><strong>Статус:</strong></td>
                                <td>Активный</td>
                            </tr>
                            <tr>
                                <td><strong>Ф.И.О:</strong> </td>
                                <td><?=$model->courier->user->fullnameemp?></td>
                                <td><strong>Област:</strong></td>
                                <td><?=$model->courier->user->oblast->name_obl?></td>
                            </tr>
                            <tr>
                                <td><strong>Дни недели:</strong> </td>
                                <td style="color:#FF0000;"><?=\app\models\WeeksName::weeks()[$model->courier->week_number]?></td>
                                <td><strong>Привязан в:</strong></td>
                                <td><?=$model->courier->created->fullnameemp?></td>

                            </tr>


                            </tbody>
                        </table>
                    <?php else: ?>

                        <p class="text-center">
                            <i class="fa fa-exclamation-triangle fa-5x" aria-hidden="true"></i>
                        </p>
                        <?php if(\app\models\config\Ruxsatnoma::isHuquqRahbariyat()):?>
                            <p>
                                <?= Html::a(Yii::t('app', 'Привязать к курьер'), ['setcourier', 'id' => $model->user_id], ['class' => 'form-control btn btn-primary']) ?>
                            </p>
                        <?php endif;?>
                    <?php endif;?>

                </div>
            </div>
        </div>

    </div>
    <div class="row">
        
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Адрес:</h3>
                    <span class="label label-primary pull-right"><i class="fa fa-html5"></i></span>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <?php if($model->adresess!=null):?>

                        <?=DetailView::widget([
                            'model'=>$model->adresess,
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
                    <?php endif;?>

                </div>
            </div>
        </div>
    </div>


</div>
