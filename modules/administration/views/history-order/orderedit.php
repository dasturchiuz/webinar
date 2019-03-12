<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $model app\models\Orders */

$this->title = "Редактироват Номер заказа №".$model->id;

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

<div class="orders-view">
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
    <?php \yii\widgets\Pjax::begin(['formSelector' => '#editorder',// this form is submitted on change
        'submitEvent' => 'change',]); ?>
    <?php $form=ActiveForm::begin([
        'id'=>'editorder',
        'options'=>[
            'data-pjax'=>true,
        ]
    ]);?>
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
                        <th  width="50"><?=Yii::t('app', '');?></th>
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
                                <?=$form->field($modelOrder, 'item_product_qty['.$item->id.']')->textInput(['type'=>'number', 'value'=>$item->qty_item, 'class'=>'form-control formedit'])->label(false);?>
                            </td>
                            <td>
                                <div class="price-wrap">
                                    <var class="price"><?=number_format($item->summ_item, 0, ',', ' ')?> <?=Yii::t('app', 'сум');?></var>

                                </div> <!-- price-wrap .// -->
                            </td>
                            <td>
                                <?= Html::a(Yii::t('app', '<i class="fa fa-trash" aria-hidden="true"></i>'), ['delete-item', 'id' => $item->id], [
                                    'class' => 'btn btn-danger',
                                    'data' => [
                                        'confirm' => Yii::t('app', 'Вы уверены, что хотите удалить этот элемент?'),
                                        'method' => 'post',
                                    ],
                                ]) ?>
                            </td>

                        </tr>
                    <?php endforeach;?>
                    <tr>
                        <td colspan="1">

                        </td>
                        <td colspan="4">
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
                        <td colspan="4">
                            <strong><?=Yii::t('app', 'Всего:')?></strong>
                        </td>
                        <td  colspan="2">
                            <strong><?=number_format($model->sum, 0, ',', ' ')?>  <?=Yii::t('app', 'сум');?></strong>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5"></td>
                        <td colspan="2">
                            <?= Html::a(Yii::t('app', ' ОК'), ['/administration/history-order/order-view', 'order_id'=>$model->id,'profile_id'=>$modelmagazin->user_id], [
                            'class' => 'btn btn-primary',

                            ]) ?>
                            <?=Html::submitButton(Yii::t('app', 'Редактировать'), ['class'=>'btn btn-primary'])?>

                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>


        </div>
    </div>
    <?php ActiveForm::end();?>
    <?php \yii\widgets\Pjax::end(); ?>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Добавить товары</h3>
            <span class="label label-primary pull-right"><i class="fa fa-info-circle"></i></span>
        </div><!-- /.box-header -->
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,

                'columns' => [

                    [
                        'attribute'=>'feature_image',
                        'format'=>'raw',
//                'value'=>function($data){
//
//                    return $data->feature_image;
//                },
                        'value' => function ($data) {
                            return '<div class="text-center">'. Html::img(Yii::getAlias('@web'). $data->getImage()->getUrl("64x"),
                                ['width' => '70px']).'</div>';
                        },
                    ],
                    'name',
                    [
                        'attribute'=>'category_id',
                        'format'=>'raw',
                        'value'=>function($data){
                            if($data->category!=null)
                                return $data->category->name;
                            else
                                return "Без категории";
                        },
                    ],

                    'amount',
                    //'related_products:ntext',

                    //'code',
                    [
                        'label'=>'Цена прадажа',
                        'format'=>'raw',
                        'value'=>function($data){
                            return $data->cartprice['cost_price'];
                        },
                    ],
                    'price',
                    'price_protsent',
                    //'text:ntext',
                    //'short_text',
                    //'is_new',
                    //'is_popular',

                    'available',
                    //'sort',
                    //'slug',

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template'=>'{add-to-order} ',
                        'buttons'=>[
                            'add-to-order'=>function($url, $model){
                                return Html::a('<i class="fa fa-plus" aria-hidden="true"></i>', ['add-to-order', 'product_id'=>$model->id, 'order_id'=>Yii::$app->request->get('order_id')], [
                                    'title' => Yii::t('app', 'Дабовить'),
                                    'class'=>'btn btn-primary',
                                    'data' => [
                                        'method' => 'post',
                                    ],

                                ]);
                            },
                        ],
                    ],
                ],
            ]); ?>
        </div>
    </div>
<?php
$this->registerJs("
//    $('.formedit').change( function() {
//   var shart=$(this).val();
////alert(shart);
//        $('#editorder').submit();
//
//});
//
//$('form#editorder').on('beforeSubmit', function () {alert('hello')});
");

?>



</div>
