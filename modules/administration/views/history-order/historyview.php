<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\administration\models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
if($model->role=='client_juridical')

$this->title = Yii::t('app', 'Заказы '.$model->juridic->orgon->name." \"".$model->juridic->tashkilot."\" - ".$model->user->user_id);
else
    $this->title = Yii::t('app', 'Заказы '.$model->fullnameemp." - ".$model->user->user_id);
if($model->role=='client_juridical')
    $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Юридическое лицо'), 'url' => ['/administration/clientjuridical/']];
else
    $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Физическое лицо'), 'url' => ['/administration/client/']];
if($model->role=='client_juridical')
$this->params['breadcrumbs'][] =['label' =>  $model->juridic->orgon->name." \"".$model->juridic->tashkilot."\" - ".$model->user->user_id, 'url' => ['/administration/clientjuridical/client-info', 'id'=>$model->user_id]];
else
$this->params['breadcrumbs'][] =['label' =>  'Заказы '.$model->fullnameemp." - ".$model->user->user_id, 'url' => ['/administration/client/client-info', 'id'=>$model->user_id]];

$this->params['breadcrumbs'][] = $this->title;

?>

<div class="orders-index">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            <span class="label label-primary pull-right"><i class="fa fa-html5"></i></span>
        </div><!-- /.box-header -->
        <div class="box-body">
            


            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

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
                            return $model->agent->user->user_id;
                        },
                    ],
                    //'termsofuse',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template'=>'{order-view} ',
                        'buttons'=>[
                            'order-view'=>function($url, $model){
                                return Html::a('<i class="fa fa-bars"></i>', ['order-view', 'profile_id'=>$model->user_id, 'order_id'=>$model->id], [
                                    'title' => Yii::t('app', 'Просмотрите заказ'),
                                ]);
                            },
                        ],
                    ],
                ],
            ]); ?>
        </div><!-- /.box-body -->
    </div><!-- /.box -->

</div>
