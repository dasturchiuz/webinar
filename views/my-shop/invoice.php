<?php

use yii\helpers\Html;
use yii2assets\printthis\PrintThis;
?>
<?php if(!empty($model->profile->juridical) && !empty($model->profile->juridical)): ?>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode("Cчёт фактура") ?> </h3>
             <?= PrintThis::widget([
        'htmlOptions' => [
            'id' => 'schyotfaktura',
            'btnClass' => 'btn btn-info',
            'btnId' => 'btnPrintThis',
            'btnText' => 'Печатать',
            'btnIcon' => 'fa fa-print'
        ],
        'options' => [
            'debug' => false,
            'importCSS' => true,
            'importStyle' => true,
            //'loadCSS' => "/css/site.css",
            'pageTitle' => "",
            'removeInline' => false,
            'printDelay' => 333,
            'header' => null,
            'formValues' => true,
        ]
    ]);?>
        </div><!-- /.box-header -->
        <div id="schyotfaktura">
            <style>
                @page{
                    size: A4 landscape;
                }
            </style>
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
                    <p class="text-center text-bold">СЧЕТ-ФАКТУРА № <?php //=$model->id?> _____ от <?=date('d ', $model->created_at).$arr[date('n', $model->created_at)-1].date(' Y г.', $model->created_at); ?></p>
                    <p class="text-center text-bold">к документу: Договор № <?=$model->profile->juridical->contract_number?> от
                        <?php if($model->profile->juridical->contract_date !="0000-00-00") echo date('d ', strtotime($model->profile->juridical->contract_date)).$arr[date('n', strtotime($model->profile->juridical->contract_date))-1].date(' Y г.', strtotime($model->profile->juridical->contract_date)); else echo "________"; ?></p>
                </div>
            </div>
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-md-6" style="width: 50%;">
                    <div class="schyotfakrekvizit">
                        <p><strong>Поставщик: </strong> <?=$model->seller->juridic->orgon->name." \"".$model->seller->juridic->tashkilot."\""?></p>
                        <p><strong>Адрес: </strong>  <?=$model->seller->manzilschyot?></p>
                        <p><strong>Телефон: </strong> <?=$model->seller->tell?></p>
                        <p><strong>Спец.Сч: </strong> Р/с: <?=$model->seller->juridic->hisobraqam?></p>
                        <p><strong>В банке: </strong><?=$model->seller->juridic->bank?></p>
                        <p><strong>МФО: </strong> <?=$model->seller->juridic->mfo?></p>
                        <p><strong>ИНН: </strong> <?=$model->seller->juridic->bank?></p>
                        <p><strong>ОКЭД: </strong> <?=$model->seller->juridic->oked?></p>
                    </div>
                </div>
                <div class="col-md-6"  style="width: 50%;">
                    <div class="schyotfakrekvizit">
                        <?php if(!empty($model->profile->juridic)) :?>
                        <p><strong>Покупатель: </strong> <?=$model->profile->juridic->orgon->name." \"".$model->profile->juridic->tashkilot."\""?></p>
                        <p><strong>Адрес: </strong>  <?=$model->profile->manzilschyot?></p>
                        <p><strong>Телефон: </strong> <?=$model->profile->tell?></p>
                        <p><strong>Спец.Сч: </strong> Р/с: <?=$model->profile->juridic->hisobraqam?></p>
                        <p><strong>В банке: </strong><?=$model->profile->juridic->bank?></p>
                        <p><strong>МФО: </strong> <?=$model->profile->juridic->mfo?></p>
                        <p><strong>ИНН: </strong> <?=$model->profile->juridic->bank?></p>
                        <p><strong>ОКЭД: </strong> <?=$model->profile->juridic->oked?></p>
                        <?php else: ?>
                            <p><strong>Покупатель: </strong> <?=$model->profile->fullnameemp?></p>
                            <p><strong>Адрес: </strong>  <?=$model->profile->manzilschyot?></p>
                            <p><strong>Телефон: </strong> <?=$model->profile->tell?></p>
                        <?php endif;?>
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
                <div class="col-md-4"  style="width: 33%;">
                    <p>Руководитель___________/ <?=$model->seller->lastname ?>. <?=substr($model->seller->firstname, 0, 1)  ?>/</p>
                    <p>Гл. бухгалтер______/ _______________./</p>
                    <p>Отпустил(а)</p>
                    <p style="margin: 0px;padding-top: 10px;" class="text-center">_________________________________________<br><small >(подпись ответственного лица от поставщика)</small></p>

                </div>
                <div class="col-md-4"  style="width: 33%;"></div>
                <div class="col-md-4 "  style="width: 33%;">
                    <p>Получил___________________________________________<br><small >(подпись покупателя или уполномоченного лица)</small></p>
                    <br>
                    <p>По доверенности № _____ от _____________</p><br>
                    <p style="margin: 0px;line-height: 0.5;" class="text-center">___________________________________________</p>

                </div>
            </div>




        </div>
    </div>

<?php endif;?>