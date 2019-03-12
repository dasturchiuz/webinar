<?php

use  yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Profile */
$this->title="Курьер: ".$model->fullnameemp;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Юридическое лицо'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-view">
<div class="row">
    <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Курьер</h3>
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
                        'created_at:datetime',
                    ],
                ]) ?>

            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Доставка на сегодня</h3>
                <span class="label label-primary pull-right"><i class="fa fa-html5"></i></span>
            </div><!-- /.box-header -->
            <div class="box-body">

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        //'filterModel' => $searchModel,
                        'layout'=>"  \n {summary} \n {items} {pager}",
                        'summary'=>"<div class='pull-right'>".Yii::t('app', "Заказы")." {begin} - {end} ".Yii::t('app', "из")." {totalCount} </div>",
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'id',

                            [
                                'attribute'=> 'created_at',
                                'format'=>'raw',
                                'label'=>'Дата покупки',
                                'value'=>function($model){
                                    return date("Y-m-d H:i:s", $model->created_at);
                                },
                            ],
                            'pay_method_name',
                            //'updated_at',
                            //'qty',
                            [
                                'attribute'=>'sum',
                                'format'=>'raw',
                                'value'=>function($model){
                                    return number_format($model->sum, 0, ',', ' '). " сум";
                                },
                            ],

                            [
                                'label'=>'V-Status',
                                'format'=>'raw',
                                'value'=>function($model){
                                    return "Нет";
                                },
                            ],
                            [
                                'label'=>'Заказ принял',
                                'format'=>'raw',
                                'attribute'=>'created_by',
                                'value'=>function($model){
                                    return $model->agent->user->username;
                                },
                            ],
                            //'termsofuse',
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'template'=>'{order-view} ',
                                'buttons'=>[
                                    'order-view'=>function($url, $model){
                                        return Html::a('<i class="fa fa-bars"></i>', ['/administration/history-order/order-view', 'profile_id'=>$model->user_id, 'order_id'=>$model->id], [
                                            'title' => Yii::t('app', 'Просмотрите заказ'),
                                        ]);
                                    },
                                ],
                            ],
                        ],
                    ]); ?>


            </div>
        </div>
    </div>
    </div>
    <div class="row">


    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?= Html::encode($this->title) ?> - <?=$zagruzka==true ? "<b class='text-danger text-bold'>Уже загрузил</b>" :  "<b class='text-danger text-bold'>Не загрузил</b>"?></h3>
                <span class="label label-primary pull-right"><i class="fa fa-html5"></i></span>
            </div><!-- /.box-header -->
            <div class="box-body">
                <?php $form = ActiveForm::begin([
                    'id' => 'load-form',
                    'fieldConfig' => [
                        'options' => [
                            'tag' => false,
                        ],
                    ],
                ]); ?>
                <?php
                $qty_all=0;
                $loaded_qty=0;
                $qty_all_sum=0;
                $loaded_qty_sum=0;

                ?>
                <table class="table table-bordered table-hover">
                    <tr class="info" style="font-weight: 700;">
                        <td>№ - товара</td>
                        <td>Название</td>
                        <td>Кол-во<br>  к загрузке</td>
                        <td>Кол-во<br> в склад</td>
                        <td>Загрузил</td>
                        <td>Оcтаток</td>
                        <td >Сумма</td>
                        <td>Цена </td>
                        <td>Статус</td>
                    </tr>
                    <tbody>

                    <?php if(isset($modelForm) && !empty($modelForm)) :?>
                        <?php $i=0; foreach($modelForm as $index => $courieritem):?>
                            <?=$courieritem->id!=null ? $form->field($courieritem, '['.$index.']id', ['template'=>'{input}'])->hiddenInput() : ""?>
                            <tr>
                                <td><?=$form->field($courieritem, '['.$index.']product_id', ['template'=>'{input}'])->hiddenInput()?><?=$courieritem->product_id?></td>
                                <td><?=$form->field($courieritem, '['.$index.']prname', ['template'=>'{input}'])->hiddenInput()?><?=$courieritem->prname?></td>
                                <td><?=$form->field($courieritem, '['.$index.']qty', ['template'=>'{input}'])->hiddenInput()?><?=$courieritem->qty; $qty_all+=$courieritem->qty;?></td>
                                <td><?=$form->field($courieritem, '['.$index.']amount', ['template'=>'{input}'])->hiddenInput()?><?=$courieritem->amount?></td>
                                <td><?=$form->field($courieritem, '['.$index.']qty_loaded', ['template'=>'{input}'])->textInput(['type'=>'number']);$loaded_qty+=$courieritem->qty_loaded;?></td>
                               <td><?php $ostatok=$courieritem->qty - $courieritem->qty_loaded; echo $ostatok>=0 ? $ostatok : "<b class='text-danger'>".$ostatok."</b>"?></td>
                                <td><?=$form->field($courieritem, '['.$index.']product_price', ['template'=>'{input}'])->hiddenInput()?><?=number_format($courieritem->product_price, 0, ',', ' '); $qty_all_sum+=$courieritem->product_price;?></td>
                                <td><?=$form->field($courieritem, '['.$index.']price_item', ['template'=>'{input}'])->hiddenInput()?><?=number_format($courieritem->price_item, 0, ',', ' ')?></td>
                                <td><?=$courieritem->status!=null ? \app\models\courieractions\CourierLoadedProducts::statuses()[$courieritem->status] : ""?></td>
                            </tr>

                    <?php  endforeach;  endif;?>
                    <tr class="info" style="font-weight: 700;">
                        <td colspan="2"></td>

                        <td><?=$qty_all?></td>
                        <td></td>
                        <td><?=$loaded_qty?></td>
                        <td> </td>
                        <td><?=number_format($qty_all_sum, 0, ',', ' ');?> </td>
                        <td ></td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>
                <p class="text-right"><?= Html::a('Вазврот тавары', ['/administration/courier-actions/courier-return', 'id'=>$model->user_id], ['class' => 'btn btn-danger']) ?> <?= Html::a('Обнавить',['/administration/courier-actions/courier', 'id'=>$model->user_id], ['class' => 'btn btn-primary']) ?> <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary',
                        'data' => [
                        'confirm' => Yii::t('app', 'Если нажать на ОК, в статусе курьера будет принятые товары'),
                        'method' => 'post',
                    ],]) ?> </p>

                <?php ActiveForm::end(); ?>




            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>


</div>