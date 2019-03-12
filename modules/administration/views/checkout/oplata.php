<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\money\MaskMoney;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */

$this->title = "Оформить доставку №".$model->id." ";

if($modelmagazin->role=='client_juridical')
    $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Юридическое лицо'), 'url' => ['/administration/clientjuridical/']];
else
    $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Физическое лицо'), 'url' => ['/administration/client/']];

if($modelmagazin->role=='client_juridical')
    $this->params['breadcrumbs'][] =['label' =>  "Оформить доставку №20 оплата при доставке ". $modelmagazin->juridic->orgon->name." \"".$modelmagazin->juridic->tashkilot."\" - ".$modelmagazin->user->user_id, 'url' => ['/administration/clientjuridical/client-info', 'id'=>$modelmagazin->user_id]];
else
    $this->params['breadcrumbs'][] =['label' =>  'Заказы '.$modelmagazin->fullnameemp." - ".$modelmagazin->user->user_id, 'url' => ['/administration/client/client-info', 'id'=>$modelmagazin->user_id]];
if($modelmagazin->role=='client_juridical')
    $this->params['breadcrumbs'][] =['label' =>  Yii::t('app', 'Заказы '.$modelmagazin->juridic->orgon->name." \"".$modelmagazin->juridic->tashkilot."\" - ".$modelmagazin->user->user_id), 'url'=>['/administration/history-order/client', 'profile_id'=>$modelmagazin->user_id]];
else
    $this->params['breadcrumbs'][] =['label' =>  'Заказы '.$modelmagazin->fullnameemp." - ".$modelmagazin->user->user_id, 'url'=>['/administration/history-order/client', 'profile_id'=>$modelmagazin->user_id]];

$this->params['breadcrumbs'][] = $this->title;
?>
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
                            <td class="text-primary text-bold">
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
    <div class="row">
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= Html::encode($this->title) ?> </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                        <?php $form = ActiveForm::begin([
                            'enableAjaxValidation' => true,
                        ]); ?>





                        <?= $form->field($modelForm, 'order_id')->hiddenInput(['value'=>$model->id])->label(false) ?>
                        <?= $form->field($modelForm, 'method_pay')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Paymethod::find()->all(), 'id', 'pay_name'));?>
                        <?= $form->field($modelForm, 'pay_sum')->widget(MaskMoney::classname(), [
                            'options' => [
                                'placeholder' => 'Введите сумму...'
                            ],
                            'pluginOptions' => [
                                'prefix' => '$ ',
                                'suffix' => ' сум',
                                'precision' =>null,
                                'allowNegative' => true,
                                'allowZero' => true,

                            ]
                        ]); ?>
                        <?= $form->field($modelForm, 'debit_sum')->widget(MaskMoney::classname(), [
                            'options' => [
                                'placeholder' => 'Введите сумму...'
                            ],
                            'pluginOptions' => [
                                'prefix' => '$ ',
                                'suffix' => ' сум',
                                'precision' =>null,
                                'allowNegative' => true,
                                'allowZero' => true,

                            ]
                        ]); ?>
                        <?=$form->field($modelForm, 'debit_date')->widget(DatePicker::classname(),[
                            'language'=>'ru',

                            'options' => ['placeholder' => 'Выберите дату ...'],
                            'pluginOptions' => [
                                'format' => 'yyyy-mm-dd',
                                'todayHighlight' => true
                            ]
                        ])->label('Вернуть долг  число') ?>
                        <?= $form->field($modelForm, 'comment_text')->textArea(['rows'=>2, 'placeholder'=>'комментарий'])->label('Комментарий') ?>
                       <p class="text-right"> <?= Html::submitButton('Оформить доставку', ['class' => 'btn btn-primary']) ?></p>
                        <?php ActiveForm::end(); ?>


<hr>




                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">История платежей</h3>
                    <span class="label label-primary pull-right"><i class="fa fa-info-circle"></i></span>
                </div><!-- /.box-header -->
                <div class="box-body">

                        <?=\yii\grid\GridView::widget([
                            'dataProvider'=>$dataProvider,
                            'layout'=>"  \n<div class='pull-left'> {summary}</div> \n {items} {pager}",
                            'emptyText'=>'Платежей не найдено',
                            'summary'=>"<div class='pull-right'>".Yii::t('app', "История платежей")." {begin} - {end} ".Yii::t('app', "из")." {totalCount} </div>",
                            'columns'=>[
                                //'id',
                                ['class'=>'yii\grid\SerialColumn'],
                                [
                                    'attribute'=>'in_date',
                                    'format'=>'raw',
                                    'value'=>function($model) use ($arr){
                                        return date('d ',strtotime($model->in_date)).$arr[date('n',strtotime( $model->in_date))-1].date(' Y г.', strtotime($model->in_date))."-".date('H:m ',strtotime($model->in_date));
                                    }
                                ],
                                [
                                    'attribute'=>'pay_id',
                                    'format'=>'raw',
                                    'value'=>function($model){
                                        return $model->pay->pay_name;
                                    },
                                ],[
                                    'attribute'=>'created_by',
                                    'format'=>'raw',
                                    'value'=>function($model){
                                        return $model->created_by != 0 ? $model->createdBy->fullnameemp."(".$model->createdBy->usernameid.")" : "";
                                    },
                                ],
                                [
                                    'attribute'=>'amount',
                                    'format'=>'html',
                                    'value'=>function($model){
                                        if($model->status==1)
                                            return "<span style='color:#20c997;'>".number_format($model->amount, 2, ',', ' ')." сум</span>";
                                        else
                                            return "<span style='color:#fb010b;'>".number_format($model->amount, 2, ',', ' ')." сум</span>";
                                    }
                                ],
                                'in_desc',
                                [
                                    'attribute'=>'status',
                                    'format'=>'raw',
                                    'value'=>function($data){
                                        return $data->status==1 ? "<a class='btn btn-success'><span class='glyphicon glyphicon-ok'></span> Оплачен</a>" :  "<a class='btn btn-danger'><span class='glyphicon glyphicon-remove'></span> Отменен</a>" ;
                                    }
                                ]
                            ]
                        ])?>


                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">История долга</h3>
                    <span class="label label-primary pull-right"><i class="fa fa-info-circle"></i></span>
                </div><!-- /.box-header -->
                <div class="box-body">

                        <?=\yii\grid\GridView::widget([
                            'dataProvider'=>$dataProvider1,
                            'layout'=>"  \n<div class='pull-left'> {summary}</div> \n {items} {pager}",
                            'emptyText'=>'Платежей не найдено',
                            'summary'=>"<div class='pull-right'>".Yii::t('app', "История долг")." {begin} - {end} ".Yii::t('app', "из")." {totalCount} </div>",
                            'columns'=>[
                                //'id',
                                ['class'=>'yii\grid\SerialColumn'],
                                [
                                    'attribute'=>'repay_date',
                                    'format'=>'raw',
                                    'value'=>function($model) use ($arr){
                                        return date('d ',strtotime($model->repay_date)).$arr[date('n',strtotime( $model->repay_date))-1].date(' Y г.', strtotime($model->repay_date));
                                    }
                                ],[
                                    'attribute'=>'created_by',
                                    'format'=>'raw',
                                    'value'=>function($model){
                                        return $model->createdBy !=null ? $model->createdBy->fullnameemp."(".$model->createdBy->usernameid.")" : "deleted";
                                    },
                                ],
                                [
                                    'attribute'=>'amount',
                                    'format'=>'html',
                                    'value'=>function($model){
                                        if($model->status==$model::STATUS_OFF)
                                        return "<span style='color:#20c997;text-decoration: line-through;'>".number_format($model->amount, 2, ',', ' ')." сум</span>";
                                        else
                                            return "<span style='color:#c82333;'>".number_format($model->amount, 2, ',', ' ')." сум</span>";

                                    }
                                ],
                                [
                                    'attribute'=>'status',
                                    'format'=>'html',
                                    'value'=>function($model){
                                        if($model::STATUS_NEW==$model->status){
                                            return "Активный долг";
                                        }elseif($model::STATUS_OFF==$model->status){
                                            return "Не активный долг";
                                        }else{
                                            return "Системний ошибка! Сообщат программисту";
                                        }

                                    }
                                ],
//                                 'status',
                            ]
                        ])?>


                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Оплата через payme</h3>
                    <span class="label label-primary pull-right"><i class="fa fa-info-circle"></i></span>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <p>
                    <form method="POST" class="form-inline" action="https://checkout.paycom.uz">

                        <!-- Идентификатор WEB Кассы -->
                        <input type="hidden" name="merchant" value="5b483d432070767c46948e9d"/>

                        <!-- Сумма платежа в тиинах -->
                        <input type="hidden" id="sendsumma" name="amount" value=""/>
                        <?php
                        echo MaskMoney::widget([
                            'name' => 'amount_summ',
                            'id'=>'amount_summ',
                            'value' => null,
                            'options' => [
                                'maxlength'=>10,
                                'placeholder' => 'Введите сумму...'
                            ],
                            'pluginOptions' => [
                                'prefix' => '$ ',
                                'suffix' => ' сум',
                                'precision' =>null,
                                'allowNegative' => true,
                                'allowZero' => true,

                            ]
                        ]);
                        ?>

                        <!-- Поля Объекта Account -->
                        <input type="hidden" name="account[order_id]" value="<?=$model->id?>"/>
                        <input type="hidden" name="account[created_id]" value="<?=Yii::$app->user->identity->username?>"/>
                        <input type="hidden" name="account[account_id]" value="<?=$modelmagazin->user->user_id?>"/>


                        <input type="hidden" name="callback" value="https://alior.creators.uz/administration/checkout/payhere?profile_id=60&order_id=72"/>


                        <input type="hidden" name="callback_timeout" value="20000"/>

                        <input type="hidden" name="description" value="Оформить доставку <?=$model->id?> оплата при доставке
Home "/>

                        <button type="submit" class="btn btn-primary" onclick="document.getElementById('sendsumma').value=(document.getElementById('amount_summ').value.trim())*100">PayME</button>

                    </form></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Остаток за долг</h3>
                    <span class="label label-primary pull-right"><i class="fa fa-info-circle"></i></span>
                </div><!-- /.box-header -->
                <div class="box-body">

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Оплатить долг</h3>
                    <span class="label label-primary pull-right"><i class="fa fa-info-circle"></i></span>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <?php $formDolg=ActiveForm::begin([ 'enableAjaxValidation' => true,]);?>
                        <?=$formDolg->field($vernutDolg, 'order_id')->hiddenInput(['value'=>$model->id])->label(false) ?>
                        <?=$formDolg->field($vernutDolg, 'method_pay')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Paymethod::find()->all(), 'id', 'pay_name'));?>
                    <?= $formDolg->field($vernutDolg, 'debit_summ')->widget(MaskMoney::classname(), [
                        'options' => [
                            'placeholder' => 'Введите сумму...'
                        ],
                        'pluginOptions' => [
                            'prefix' => '$ ',
                            'suffix' => ' сум',
                            'precision' =>null,
                            'allowNegative' => true,
                            'allowZero' => true,

                        ]
                    ]); ?>
                    <p class="text-right"> <?= Html::submitButton('Вернуть долг', ['class' => 'btn btn-primary']) ?></p>

                    <?php ActiveForm::end(); ?>

                </div>
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
                        <p>Руководитель________________/ Tursimatov D.SH/</p>
                        <p>Гл. бухгалтер________________/ Tursimatov D.SH/</p>
                        <p>Отпустил(а)</p>
                        <p style="margin: 0px;" class="text-center">_________________________________________<br><small >(подпись ответственного лица от поставщика)</small></p>

                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <p>Получил___________________________________________<br><small >(подпись покупателя или уполномоченного лица)</small></p>
                        <br>
                        <br>
                        <p>По доверенности № _____ от _____________</p>
                        <p style="margin: 0px;line-height: 0.5;" class="text-center"><?=$model->profile->fullnameemp?> <br><small >___________________________________________________________</small></p>

                    </div>
                </div>




            </div>
        </div>

    <?php endif;?>





</div>
