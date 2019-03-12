<?php
use  yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Profile */
$this->title="Возврат товара из курьер: ".$model->fullnameemp;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-view">
    
    <div class="row">


        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
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
                    <table class="table table-bordered table-hover">
                        <tr class="info" style="font-weight: 700;">
                            <td>№ - товара</td>
                            <td>Название</td>
                            <td>Кол-во  к загрузке</td>
                            <td>Загрузил</td>
                            <td>Оcтаток</td>
                            <td>возврат</td>

                            <td>Сумма</td>
                            <td>Статус</td>
                        </tr>
                        <tbody>

                        <?php if(isset($modelForm) && !empty($modelForm)) :?>
                            <?php
                            $qty_all=0;
                            $loaded_qty=0;
                            $qty_all_sum=0;
                            $loaded_qty_sum=0;

                            ?>
                            <?php $i=0; foreach($modelForm as $index => $courieritem):?>
                                <?=$courieritem->id!=null ? $form->field($courieritem, '['.$index.']id', ['template'=>'{input}'])->hiddenInput() : ""?>
                                <tr>
                                    <td><?=$courieritem->product_id?></td>
                                    <td><?=$courieritem->prname?></td>
                                    <td><?=$courieritem->qty; $qty_all+=$courieritem->qty;?></td>
                                    <td><?=$courieritem->qty_loaded; $loaded_qty+=$courieritem->qty_loaded;?></td>
                                    <td><?php $ostatok=$courieritem->qty - $courieritem->qty_loaded; echo $ostatok>=0 ? $ostatok : "<b class='text-danger'>".$ostatok."</b>"?></td>
                                    <td><?php $vozvrot= $courieritem->qty_loaded - $courieritem->remnant; echo $vozvrot>=0 ? $vozvrot : "<b class='text-danger'>".$vozvrot."</b>"?></td>
                                    <td><?=number_format($courieritem->product_price, 0, ',', ' '); $qty_all_sum+=$courieritem->product_price;?></td>
                                    <td><?=$courieritem->status!=null ? \app\models\courieractions\CourierLoadedProducts::statuses()[$courieritem->status] : ""?></td>
                                </tr>

                            <?php  endforeach;  endif;?>
                        </tbody>

                    </table>
                    <p class="text-right">

                        <?= Html::a('Обнавить',['/administration/courier-actions/courier-return', 'id'=>$model->user_id], ['class' => 'btn btn-primary']) ?>
                        <?= Html::submitButton('Вазврот тавары', ['class' => 'btn btn-success',
                            'data' => [
                                'confirm' => Yii::t('app', 'При нажатие на ОК, Вы соглашаетесь с возвратом товаров и статус будет завершён'),
                                'method' => 'post',
                            ],]) ?> </p>

                    <?php ActiveForm::end(); ?>




                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>


    </div>