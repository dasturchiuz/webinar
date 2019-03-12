<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */

$this->title = "Номер заказа №".$model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Заказы'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="orders-view">
    <div class="row">
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"> Информация для заказа</h3>
                    <span class="label label-primary pull-right"><i class="fa fa-shopping-cart "></i></span>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table class="table">
                        <tr>
                            <td width="15%">
                                <span class="label label-primary"><i class="fa fa-shopping-cart "></i></span>
                            </td>
                            <td>
                                ALIOR.UZ
                            </td>
                        </tr>
                        <tr>
                            <td  width="15%">
                                <span  class="label label-primary"><i class="fa fa-calendar"></i></span>
                            </td>
                            <td>
                                <?=Html::encode($model->pay_method_name)?>
                            </td>
                        </tr>
                        <tr>
                            <td  width="15%">
                                <span  class="label label-primary"><i class="fa fa-credit-card"></i></span>
                            </td>
                            <td>
                                <?=Html::encode($model->created_at)?>
                            </td>
                        </tr>
                        <tr>
                            <td  width="15%">
                                <span  class="label label-primary"><i class="fa fa-truck "></i></span>
                            </td>
                            <td>
                                <?php
                                if(isset($model->courier->user_id))
                                    echo "<strong>".Html::encode($model->courier->lastname.' '.$model->courier->firstname )." <strong>";
                                else
                                    echo Html::encode("Не прикрепленный курьер");
                                ?>
                            </td>
                        </tr>


                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Информация о клиенте</h3>
                    <span class="label label-primary pull-right"><i class="fa fa-user"></i></span>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table class="table">
                        <tr>
                            <td width="15%">
                                <span class="label label-primary"><i class="fa fa-user "></i></span>
                            </td>
                            <td>
                                <?=Html::encode($model->user->lastname. " ".$model->user->firstname )?>
                            </td>
                        </tr>
                        <tr>
                            <td  width="15%">
                                <span  class="label label-primary"><i class="fa fa-group"></i></span>
                            </td>
                            <td>
                                <?=Html::encode($model->user->role)?>
                            </td>
                        </tr>
                        <tr>
                            <td  width="15%">
                                <span  class="label label-primary"><i class="fa fa-envelope-o"></i></span>
                            </td>
                            <td>
                                <?=Html::encode($model->user->tell)?>
                            </td>
                        </tr>
                        <tr>
                            <td  width="15%">
                                <span  class="label label-primary"><i class="fa fa-phone "></i></span>
                            </td>
                            <td>
                                <?=Html::encode($model->user->tell)?>
                            </td>
                        </tr>


                    </table>
                </div>

            </div>
        </div>
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Опции</h3>
                    <span class="label label-primary pull-right"><i class="fa fa-cog"></i></span>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table class="table">
                        <tr>
                            <td width="15%">
                                <span class="label label-primary"><i class="fa fa-globe"></i></span>
                            </td>
                            <td>
                                <?=Html::encode($model->region->name_obl )?>
                            </td>
                        </tr>
                        <tr>
                            <td  width="15%">
                                <span  class="label label-primary"><i class="fa fa-money"></i></span>
                            </td>
                            <td>
                                <?=Html::encode(number_format($model->sum, 0, ',', ' '). " сум")?>
                            </td>
                        </tr>
                        <tr>
                            <td  width="15%">
                                <span  class="label label-primary"><i class="fa fa-envelope-o"></i></span>
                            </td>
                            <td>
                                <?=Html::encode($model->statuses[$model->status])?>
                            </td>
                        </tr>
                        <tr>
                            <td  width="15%">
                                <span  class="label label-primary"><i class="fa fa-phone "></i></span>
                            </td>
                            <td>
                                <?=Html::encode($model->statuses[$model->pay_status])?>
                            </td>
                        </tr>


                    </table>
                </div>
            </div>
        </div>


    </div>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?> </h3>
            <span class="label label-primary pull-right"><i class="fa fa-info-circle"></i></span>
        </div><!-- /.box-header -->
        <div class="box-body">


            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <th>Адрес доставки</th>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <?=Html::encode($model->adress)?>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?=Html::encode($model->phone)?>


                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?=Html::encode($model->email)?>
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th><?=Yii::t('app', 'Продукт');?></th>
                        <th width="140"><?=Yii::t('app',  'Цена за единицу');?></th>
                        <th width="120"><?=Yii::t('app','Скидка');?></th>
                        <th width="120"><?=Yii::t('app','Количество');?></th>

                        <th  width="180"><?=Yii::t('app', 'Всего');?></th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php foreach($model->orderItems as $id => $item):?>
                        <tr>
                            <td>
                                <figure class="media">
                                    <div class="img-wrap"><img src="<?=$item->product->getImage()->getUrl("90x");?>" class="img-thumbnail img-lg"></div>
                                    <figcaption class="media-body">
                                        <h6 class="title text-truncate"><?=Html::a($item->name, ['/product/', 'id'=>$item->product_id])?></h6>
                                    </figcaption>
                                </figure>
                            </td>
                            <td>
                                <?=number_format($item->price, 0, ',', ' ')?> <?=Yii::t('app', 'сум');?>
                            </td>
                            <td>
                                <?php if($item->discount_id!=null):?>
                                    <?=$item->discount?>
                                <?php endif;?>
                            </td>

                            <td>
                                <?=$item->qty_item?> / <?php if($item->product->unit!=null) echo $item->product->unit->unit_name;?>
                            </td>
                            <td>
                                <div class="price-wrap">
                                    <var class="price"><?=number_format($item->summ_item, 0, ',', ' ')?> <?=Yii::t('app', 'сум');?></var>
                                    <small class="text-muted">(USD5 each)</small>
                                </div> <!-- price-wrap .// -->
                            </td>

                        </tr>
                    <?php endforeach;?>
                    <tr>
                        <td colspan="1">

                        </td>
                        <td colspan="2">
                            <strong> <?=Yii::t('app', 'Промежуточный итог:')?></strong>
                        </td>
                        <td>
                            <strong><?=number_format($model->sum, 0, ',', ' ')?>  <?=Yii::t('app', 'сум');?></strong>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="1">

                        </td>
                        <td colspan="2">
                            <strong><?=Yii::t('app', 'Всего:')?></strong>
                        </td>
                        <td>
                            <strong><?=number_format($model->sum, 0, ',', ' ')?>  <?=Yii::t('app', 'сум');?></strong>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>


        </div>
    </div>

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Историю заказов</h3>
            <span class="label label-primary pull-right"><i class="fa fa-html5"></i></span>
        </div><!-- /.box-header -->
        <div class="box-body">
            <h3 class="box-title">Добавить Курьер для заказов</h3><hr>

            <?php $form=ActiveForm::begin();?>
            <?php
                $profiles= \app\models\Profile::find()->where(['region_id'=>Yii::$app->user->identity->getRegionId(), 'role'=>'сouriers'])->all();


            ?>
            <?=$form->field($model, 'courier_id')->dropDownList(ArrayHelper::map($profiles, 'user_id', function($profiles, $defaultValue){
                return $profiles->lastname.' '.$profiles->firstname.' '.$profiles->fathername.' Логин: '.$profiles->user->username.' Регион: '.$profiles->oblast->name_obl;
            }), ['prompt'=>'Выбирет'])->label("Курьеры");?>

            <?=Html::submitButton(Yii::t('app', ' Добавить Курьер'), ['class'=>'btn btn-primary']);?>

            <?php ActiveForm::end();?>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th><?=Yii::t('app', 'Дата Добавлена');?></th>
                        <th width="140"><?=Yii::t('app',  'Комментарий');?></th>
                        <th width="120"><?=Yii::t('app','Положение дел	');?></th>
                        <th  width="180"><?=Yii::t('app', 'Уведомление клиента');?></th>
                        <th  width="180"><?=Yii::t('app', 'Пользователь');?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $data_history=$model->orderHistoryStatus; if(!empty($data_history)):?>
                        <?php foreach($data_history as $item_history): ?>
                            <tr>
                                <td style="width: 15%;"><?=date("m/d/Y H:i:s", $item_history->created_at);?></td>
                                <td><?=$item_history->comment_status?></td>
                                <td><?php if($item_history->status !=null) echo $model->statuses[$item_history->status]; else echo "Статус нет";?></td>
                                <td><?=$item_history->notfy_client?></td>
                                <td><?=$item_history->user->rolename;?><br><strong><?=$item_history->user->lastname.' '.$item_history->user->firstname;?></strong>  </td>


                            </tr>
                        <?php endforeach;?>
                    <?php endif;?>
                    </tbody>
                </table>
            </div>
            <h3 class="box-title">Добавить историю заказов</h3><hr>

            <?php $form=ActiveForm::begin();?>
            <?=$form->field($order_status, 'status')->dropDownList(\app\models\Orders::getStatuses(), ['prompt'=>'Выбирет'])->label("Статус заказа");?>
            <?=$form->field($order_status, 'notfy_client')->checkBox()?>

            <?=$form->field($order_status, 'comment_status')->textArea(['rows'=>6])?>
            <?=Html::submitButton(Yii::t('app', ' Добавить историю'), ['class'=>'btn btn-primary']);?>

            <?php ActiveForm::end();?>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            <span class="label label-primary pull-right"><i class="fa fa-html5"></i></span>
        </div><!-- /.box-header -->
        <div class="box-body">







            <?= Html::a(Yii::t('app', 'Обновить'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Печать'), ['print', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Удалить'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
            </p>


        </div><!-- /.box-body -->
    </div><!-- /.box -->
</div>
