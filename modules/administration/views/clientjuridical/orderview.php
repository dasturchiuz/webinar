<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */

$this->title = "Номер заказа №".$model->id;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Клиентский юридический'), 'url' => ['index']];
$this->params['breadcrumbs'][] =['label' =>  $modelmagazin->juridic->orgon->name." \"".$modelmagazin->juridic->tashkilot."\" - ".$modelmagazin->user->user_id, 'url' => ['client-info', 'id'=>$modelmagazin->user_id]];
$this->params['breadcrumbs'][] =['label' =>  Yii::t('app', 'Заказы '.$modelmagazin->juridic->orgon->name." \"".$modelmagazin->juridic->tashkilot."\" - ".$modelmagazin->user->user_id), 'url'=>['history-order', 'profile_id'=>$modelmagazin->user_id]];
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
                                <?=Html::encode(date('Y-m-d H:m:s', $model->created_at))?>
                            </td>
                        </tr>
                        <tr>
                            <td  width="15%">
                                <span  class="label label-primary"><i class="fa fa-truck "></i></span>
                            </td>
                            <td>
                               <?=$model->delivery->deliver_name?>
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
                                <?=$modelmagazin->name_magazin?>
                            </td>
                        </tr>
                        <tr>
                            <td  width="15%">
                                <span  class="label label-primary"><i class="fa fa-group"></i></span>
                            </td>
                            <td>

                                <?=$modelmagazin->juridic->orgon->name." \"".$modelmagazin->juridic->tashkilot."\""?>
                            </td>
                        </tr>
                        <tr>
                            <td  width="15%">
                                <span  class="label label-primary"><i class="fa fa-envelope-o"></i></span>
                            </td>
                            <td>
                                <?=$modelmagazin->user->user_id?>
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
                    <tr>
                        <th width="100"><?=Yii::t('app', 'Фото');?></th>
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
                                    <div class="img-wrap"><img src="<?=$item->product->getImage()->getUrl("64x");?>" class="img-thumbnail"></div>

                                </figure>
                            </td>
                            <td>

                                        <h6 class="title text-truncate"><?=Html::a($item->name, ['/product/', 'id'=>$item->product_id])?></h6>

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
                                <?=$item->qty_item?> /
                                <?php if($item->product->unit!=null) echo $item->product->unit->unit_name;?>
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
                        <td colspan="3">
                            <strong> <?=Yii::t('app', 'Промежуточный итог:')?></strong>
                        </td>
                        <td colspan="2">
                            <strong><?=number_format($model->sum, 0, ',', ' ')?>  <?=Yii::t('app', 'сум');?></strong>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="1">

                        </td>
                        <td colspan="3">
                            <strong><?=Yii::t('app', 'Всего:')?></strong>
                        </td>
                        <td  colspan="2">
                            <strong><?=number_format($model->sum, 0, ',', ' ')?>  <?=Yii::t('app', 'сум');?></strong>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4"></td>
                        <td colspan="2">
                            <?=Html::a('Редактировать', ['edit-order', 'id'=>$model->id], ['class'=>'btn btn-success'])?>
                            <?=Html::a('Добавить товары', ['add-item-order', 'id'=>$model->id], ['class'=>'btn btn-info'])?>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>


        </div>
    </div>





</div>