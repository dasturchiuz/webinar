<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */

$this->title = "Номер заказа №".$model->id;

if($modelmagazin->role=='client_juridical')
    $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Юридическое лицо'), 'url' => ['/administration/clientjuridical/']];
else
    $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Физическое лицо'), 'url' => ['/administration/client/']];

if($modelmagazin->role=='client_juridical')
    $this->params['breadcrumbs'][] =['label' =>  $modelmagazin->juridic->orgon->name." \"".$modelmagazin->juridic->tashkilot."\" - ".$modelmagazin->user->user_id, 'url' => ['/administration/clientjuridical/client-info', 'id'=>$modelmagazin->user_id]];
else
    $this->params['breadcrumbs'][] =['label' =>  'Заказы '.$modelmagazin->fullnameemp." - ".$modelmagazin->user->user_id, 'url' => ['/administration/client/client-info', 'id'=>$modelmagazin->user_id]];
if($modelmagazin->role=='client_juridical')
$this->params['breadcrumbs'][] =['label' =>  Yii::t('app', 'Заказы '.$modelmagazin->juridic->orgon->name." \"".$modelmagazin->juridic->tashkilot."\" - ".$modelmagazin->user->user_id), 'url'=>['/administration/history-order/client', 'profile_id'=>$modelmagazin->user_id]];
else
    $this->params['breadcrumbs'][] =['label' =>  'Заказы '.$modelmagazin->fullnameemp." - ".$modelmagazin->user->user_id, 'url'=>['/administration/history-order/client', 'profile_id'=>$modelmagazin->user_id]];

$this->params['breadcrumbs'][] = $this->title;
?>

<div class="orders-view ">
    <div class="row">
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"> Информация о заказе</h3>
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
                                <?php if($modelmagazin->role=='client_juridical'):?>
                                <?=$modelmagazin->juridic->orgon->name." \"".$modelmagazin->juridic->tashkilot."\""?>
                                <?php endif;?>
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
                    <h3 class="box-title">Общая информация</h3>
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
                            <strong> <?=Yii::t('app', 'V-Status cкидка:')?></strong>
                        </td>
                        <td colspan="2">
                            <strong>---</strong>
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
                        <td colspan="2"></td>
                        <td colspan="4">

                            <?=Html::a('В долг', ['/administration/checkout/vdolg', 'profile_id'=>$modelmagazin->user_id, 'order_id'=>$model->id], ['class'=>'btn btn-danger'])?>
                            <?=Html::a('Оплата при доставки', ['/administration/checkout/payhere', 'profile_id'=>$modelmagazin->user_id, 'order_id'=>$model->id], ['class'=>'btn btn-success'])?>
                            <?=Html::a('Отказ', ['/administration/checkout/renouncement', 'profile_id'=>$modelmagazin->user_id, 'order_id'=>$model->id], ['class'=>'btn btn-warning'])?>
                            <?=Html::a('Редактировать', ['edit-order', 'profile_id'=>$modelmagazin->user_id, 'order_id'=>$model->id], ['class'=>'btn btn-info'])?>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>


        </div>
    </div>
    <?php if(!empty($model->profile->juridical)): ?>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode("Cчёт фактура") ?> </h3>
            <span class="label label-primary pull-right"><i class="fa fa-info-circle"></i></span>
        </div><!-- /.box-header -->
        <div class="box-body" id="schyotfaktura">
            <div class="row">
                <div class="col-md-12">
                    <?php $arr = [
                        'Январь',
                        'Февраль',
                        'Март',
                        'Апрель',
                        'Май',
                        'Июнь',
                        'Июль',
                        'Август',
                        'Сентябрь',
                        'Октябрь',
                        'Ноябрь',
                        'Декабрь'
                    ]; ?>
                    <p class="text-center text-bold">СЧЕТ-ФАКТУРА № <?=$model->id?> от <?=date('d ', $model->created_at).$arr[date('n', $model->created_at)-1].date(' Y г.', $model->created_at); ?></p>
                    <p class="text-center text-bold">к документу: Договор № <?=$model->profile->juridical->contract_number?> от  <?php if($model->profile->juridical->contract_date !="0000-00-00") echo date('d ', strtotime($model->profile->juridical->contract_date)).$arr[date('n', strtotime($model->profile->juridical->contract_date))-1].date(' Y г.', strtotime($model->profile->juridical->contract_date)); ?></p>
                </div>
            </div>
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-md-6">
                    <div class="schyotfakrekvizit">
                        <p><strong>Поставщик: </strong> "GULASIOB"MCHJ</p>
                        <p><strong>Адрес: </strong> Самарканд улица Мир Саид Барака 32</p>
                        <p><strong>Телефон: </strong> +99893 3300306</p>
                        <p><strong>Спец.Сч: </strong> Р/с: 20208000600478987001</p>
                        <p><strong>В банке: </strong> НБ ВЭД Ру. г. Самарканд</p>
                        <p><strong>МФО: </strong> 00278</p>
                        <p><strong>ИНН: </strong> 303374521</p>
                        <p><strong>ОКЭД: </strong> 19122</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="schyotfakrekvizit">
                        <p><strong>Покупатель: </strong> <?=$modelmagazin->juridic->orgon->name." \"".$modelmagazin->juridic->tashkilot."\""?></p>
                        <p><strong>Адрес: </strong>  <?=$model->profile->manzilschyot?></p>
                        <p><strong>Телефон: </strong> <?=$model->profile->tell?></p>
                        <p><strong>Спец.Сч: </strong> Р/с: <?=$model->profile->juridic->hisobraqam?></p>
                        <p><strong>В банке: </strong><?=$model->profile->juridic->bank?></p>
                        <p><strong>МФО: </strong> <?=$model->profile->juridic->mfo?></p>
                        <p><strong>ИНН: </strong> <?=$model->profile->juridic->bank?></p>
                        <p><strong>ОКЭД: </strong> <?=$model->profile->juridic->oked?></p>
                    </div>
                </div>


            </div>



            <table class="table table-bordered ">
                <tbody>
                <tr  class="text-center text-bold">
                    <td rowspan="2"  class="vcenter">№</td>
                    <td  rowspan="2" class="vcenter" style="width: 50px;">Код товара:</td>
                    <td colspan="7" rowspan="2" class="vcenter">Наименование товара:</td>
                    <td rowspan="2" class="vcenter">Ед.</td>
                    <td rowspan="2" class="vcenter">Кол-во</td>
                    <td rowspan="2" class="vcenter">Цена</td>
                    <td rowspan="2" class="vcenter">Сумма</td>
                    <td colspan="2">Акциз</td>
                    <td colspan="2">НДС</td>
                    <td rowspan="2" class="vcenter">Всего с НДС</td>
                </tr>
                <tr  class="text-center  text-bold">
                    <td>Ставка</td>
                    <td>Сумма</td>
                    <td>Ставка</td>
                    <td>Сумма</td>
                </tr>
                <tr class="text-center">
                    <td >&nbsp;</td>
                    <td >1</td>
                    <td colspan="7">2</td>
                    <td >3</td>
                    <td >4</td>
                    <td>5</td>
                    <td>6</td>
                    <td>7</td>
                    <td>8</td>
                    <td>9</td>
                    <td>10</td>
                    <td>11</td>
                </tr>
                <?php $i=1; foreach($model->orderItems as $id => $item):?>
                <tr>
                    <td class="text-center"><?=$i++?></td>
                    <td class="text-center"><?=$item->product_id?></td>
                    <td colspan="7"><?=$item->name?></td>
                    <td   class="text-center"><?php if($item->product->unit!=null) echo $item->product->unit->unit_name;?></td>
                    <td   class="text-right"><?=$item->qty_item?></td>
                    <td   class="text-right"> <?=number_format($item->price, 2, ',', ' ')?></td>
                    <td  class="text-right"><?=number_format($item->summ_item, 2, ',', ' ')?></td>
                    <td colspan="2"  class="text-center">Без акц.</td>
                    <td colspan="2" class="text-center">Без НДС</td>

                    <td>&nbsp;</td>
                </tr>
                <?php endforeach;?>

                <tr>
                    <td colspan="12">Всего к оплате:</td>

                    <td><strong><?=number_format($model->sum, 2, ',', ' ')?></strong></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td><strong> </strong></td>
                </tr>

                </tbody>
            </table>
            <p><strong>Всего к оплате(прописью): <span class="m_title"><?= Html::encode(\app\models\Orders::num2str($model->sum)) ?></strong></span></p>
<br>
            <div class="row">
                <div class="col-md-4">
                    <p>Руководитель________________/ Ahmedov S./</p>
                    <p>Гл. бухгалтер________________/ Rahimov M./</p>
                    <p>Отпустил(а)</p>
                    <p style="margin: 0px;padding-top: 10px;" class="text-center">_________________________________________<br><small >(подпись ответственного лица от поставщика)</small></p>

                </div>
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <p>Получил___________________________________________<br><small >(подпись покупателя или уполномоченного лица)</small></p>
                    <br>
                    <p>По доверенности № _____ от _____________</p><br>
                    <p style="margin: 0px;line-height: 0.5;" class="text-center">___________________________________________</p>

                </div>
            </div>




        </div>
    </div>

    <?php endif;?>





</div>
