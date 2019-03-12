<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;
use miloschuman\highcharts\Highcharts;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\administration\models\EmployeesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Отчёт юридических лиц: Агент '.$model->fullnameemp;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employees-index">

    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Статистика торговых точек</h3>
                    <span class="label label-primary pull-right"><i class="fa fa-html5"></i></span>
                </div><!-- /.box-header -->
                <div class="box-body" id="datagridvie">
                    <?php $form=ActiveForm::begin([
                        'layout' => 'horizontal',
                        'method' => 'get',
                        'action'=>'/administration/report/clientjuridicalbyid',

                    ])?>
                    <input type="hidden" name="user_id" value="<?=$user_id?>">

                    <div class="row">
                        <div class="col-md-10">
                            <?php
                            echo DatePicker::widget([
                                'name' => 'statis_date',
                                'language'=>'ru',
                                'value'=>Yii::$app->request->get('statis_date') !=null ? Yii::$app->request->get('statis_date') : '',
                                'options' => ['placeholder' => 'Выберите дату ...'],
                                'pluginOptions' => [
                                    'format' => 'yyyy-mm-dd',
                                    'todayHighlight' => true
                                ]
                            ]);

                            ?>
                        </div>
                        <div class="col-md-2">                        <?=Html::submitButton('ОК', ['class'=>'btn btn-default'])?>
                        </div>
                    </div>


                    <?php ActiveForm::end();?>
                    <br>
                    <style>table tr td:first-child{
                            font-weight: 700;
                        }</style>
                    <table class="table table-bordered">
                        <p class="text-left"><strong>Количество торговых точек: </strong><span class="badge"><?=$statis_status_count['all_yurlitso']?></span></p>

                        <p class="text-left"><strong>Количество обслуживаемых торговых точек: </strong><span class="badge"><?=$statis_status_count['all_active_yurlitso']?></span></p>
                        <tbody>
                        <tr>
                            <td>Количество заказов</td>
                            <td><?=$statis_order_count['all_orders'] ?></td>
                        </tr>
                        <tr>
                            <td>Закупка</td>
                            <td><?=$statis_order_count['purchase_orders']?></td>
                        </tr>
                        <tr>
                            <td>Закупили в долг</td>
                            <td><?=$statis_order_count['debt_orders']?></td>
                        </tr>
                        <tr>
                            <td>Отказались закупаться</td>
                            <td><?=$statis_order_count['refused_orders']?></td>
                        </tr>
                        <tr>
                            <td>Не доставленые заказы</td>
                            <td><?=$statis_order_count['notdelivered_orders'] ?></td>
                        </tr>
                        <tr>
                            <td>Оплаченные и не доставленные заказы</td>
                            <td><?=$statis_order_count['paidnotdelivered_orders']?></td>
                        </tr>
                        <tr>
                            <td>Не заказли</td>
                            <td><?=$statis_zakazchik_count['nezakazal']?></td>
                        </tr>
                        <tr>
                            <td>Не было заказчика</td>
                            <td><?=$statis_zakazchik_count['nebil']?></td>
                        </tr>
                        <tr>
                            <td>Чёрный список</td>
                            <td><?=$statis_status_count['all_block_yurlitso']?></td>
                        </tr>






                        </tbody>
                    </table>



                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Статистика продаж</h3>
                    <span class="label label-primary pull-right"><i class="fa fa-html5"></i></span>
                </div><!-- /.box-header -->
                <div class="box-body" id="datagridvie">
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <td>Сумма заказов</td>
                            <td><?=number_format($statis_order_sum['all_orders'], 0, ',', ' ')?> сум</td>
                        </tr>
                        <tr>
                            <td>Закупка</td>
                            <td><?=number_format($statis_order_sum['purchase_orders'], 0, ',', ' ')?> сум</td>
                        </tr>
                        <tr>
                            <td>Закупили в долг</td>
                            <td><?=number_format($statis_order_sum['debt_orders'], 0, ',', ' ')?> сум</td>
                        </tr>
                        <tr>
                            <td>Отказались закупаться</td>
                            <td><?=number_format($statis_order_sum['refused_orders'], 0, ',', ' ')?> сум</td>
                        </tr>
                        <tr>
                            <td>Не доставленые заказы</td>
                            <td><?=number_format($statis_order_sum['notdelivered_orders'], 0, ',', ' ')?> сум</td>
                        </tr>
                        <tr>
                            <td>Оплаченные и не доставленные заказы</td>
                            <td><?=number_format($statis_order_sum['paidnotdelivered_orders'], 0, ',', ' ')?> сум</td>
                        </tr>
                        </tbody>
                    </table>




                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div><div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Статистика торговых точек</h3>
                    <span class="label label-primary pull-right"><i class="fa fa-html5"></i></span>
                </div><!-- /.box-header -->
                <div class="box-body" id="datagridvie">
                    <?php

                    echo Highcharts::widget([
                        'scripts' => [
                            'highcharts-3d',
                        ],
                        'options' => [

                            'credits'=>[
                                'enabled'=>false
                            ],
                            'chart'=> [
                                'plotBackgroundColor'=>null,
                                'plotBorderWidth'=>null,
                                'plotShadow'=>false,
                                'type'=>'pie',
                                'options3d'=>[
                                    'enabled'=>true,
                                    'alpha'=>50
                                ]
                            ],
                            'title'=>[
                                'text'=>'',
                                'margin'=>0,
                            ],
                            'tooltip'=>[
                                'pointFormat'=> '{series.name}: <b> {point.y}шт<br>({point.percentage:.1f}%) </b>',
                            ],
                            'plotOptions'=>[
                                'pie'=>[
                                    'allowPointSelect'=>true,
                                    'cursor'=>'pointer',
                                    'innerSize'=>60,
                                    'depth'=>30,
                                    'dataLabels'=>[
                                        'enabled'=>true,
                                        'format'=>'{point.name}: <b> {point.y}шт<br>({point.percentage:.1f}%) </b>',
                                    ],
                                    //'showInLegend'=>true,
                                ],

                            ],
                            'series'=> [
                                [
                                    'name'=>'Количество',
                                    'colors'=>[
                                        '#00FF00', '#FF0000',  '#000000','#004DFF', '#FFFF00',
                                    ],
                                    'data'=>[
                                        //['Jami murojaatlar',   intval($data[0])],
                                        ['Закупка', intval($statis_order_count['purchase_orders'])],
                                        ['Закупили в<br/> долг', intval($statis_order_count['debt_orders'])],
                                        ['Отказались<br/> закупаться', intval($statis_order_count['refused_orders'])],
                                        ['Не доставленые<br/> заказы	', intval($statis_order_count['notdelivered_orders'])],
                                        ['Оплаченные <br/>и не доставленные<br/> заказы', intval($statis_order_count['paidnotdelivered_orders'])],
                                    ],
                                ]
                            ]
                        ],
                    ]);
                    ?>






                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Статистика продаж</h3>
                    <span class="label label-primary pull-right"><i class="fa fa-html5"></i></span>
                </div><!-- /.box-header -->
                <div class="box-body" id="datagridvie">


                    <?php

                    echo Highcharts::widget([
                        'scripts' => [
                            'highcharts-3d',
                        ],
                        'options' => [

                            'credits'=>[
                                'enabled'=>false
                            ],
                            'chart'=> [
                                'plotBackgroundColor'=>null,
                                'plotBorderWidth'=>null,
                                'plotShadow'=>false,
                                'type'=>'pie',
                                'options3d'=>[
                                    'enabled'=>true,
                                    'alpha'=>50
                                ]
                            ],
                            'title'=>[
                                'text'=>'',
                                'margin'=>0,
                            ],
                            'tooltip'=>[
                                'pointFormat'=> '{series.name}: {point.y} сум<br>({point.percentage:.1f}%)',
                            ],
                            'plotOptions'=>[
                                'pie'=>[
                                    'allowPointSelect'=>true,
                                    'cursor'=>'pointer',
                                    'innerSize'=>60,
                                    'depth'=>30,
                                    'dataLabels'=>[
                                        'enabled'=>true,
                                        'format'=>'{point.name}: {point.y}сум<br>({point.percentage:.1f}%)',
                                    ],
                                    //'showInLegend'=>true,
                                ],

                            ],
                            'series'=> [
                                [
                                    'name'=>'Количество',
                                    'colors'=>[
                                        '#00FF00', '#FF0000',  '#000000','#004DFF', '#FFFF00',
                                    ],
                                    'data'=>[
                                        //['Jami murojaatlar',   intval($data[0])],
                                        ['Закупка', intval($statis_order_sum['purchase_orders'])],
                                        ['Закупили в<br/> долг', intval($statis_order_sum['debt_orders'])],
                                        ['Отказались<br/> закупаться', intval($statis_order_sum['refused_orders'])],
                                        ['Не доставленые<br/> заказы	', intval($statis_order_sum['notdelivered_orders'])],
                                        ['Оплаченные <br/>и не доставленные<br/> заказы', intval($statis_order_sum['paidnotdelivered_orders'])],
                                    ],
                                ]
                            ]
                        ],
                    ]);
                    ?>




                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>



</div>