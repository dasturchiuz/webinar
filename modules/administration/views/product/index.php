<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Продукты');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            <span class="label label-primary pull-right"><i class="fa fa-html5"></i></span>
        </div><!-- /.box-header -->
        <div class="box-body">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Добавить продукт'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'id',
                'label'=>"Код товар"
            ],
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
            [
                'attribute'=>'profile_id',
                'format'=>'raw',
                'value'=>function($model){
                    $userdata=$model->addeduser;
                    if(!empty($userdata))
                    return "<small>".$userdata->rolename."</small> ".$userdata->firstname."  ".$userdata->lastname." <br> ID:".$userdata->user_id;
                    else
                        return " - -";
                }
            ],
//            [
//                'attribute'=>'aproval_id',
//                'format'=>'raw',
//                'value'=>function($model){
//                    $aproval=$model->aproval;
//                    if(!empty($aproval))
//                    return "<small>".$aproval->rolename."</small>".$aproval->firstname."  ".$aproval->lastname." <br> ID:".$aproval->user_id;
//                    else
//                        return " - -";
//                }
//            ],
            'amount',
            //'related_products:ntext',

            //'code',
            'price',
            //'price_protsent',
            //'text:ntext',
            //'short_text',
            //'is_new',
            //'is_popular',

            'available',
            //'sort',
            //'slug',

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{viewproduct} {update} {delete}',
                'buttons'=>[
                    'courier'=>function($url, $model){
                        return Html::a('<i class="fa fa-truck"></i>', $url, [
                            'title' => Yii::t('app', 'Курьер'),
                        ]);
                    },
                    'viewproduct'=>function($url, $model){
                        return Html::a('<i class="fa fa-eye"></i>', '/product/'.$model->slug, [
                            'title' => Yii::t('app', 'Смотреть'),
                        ]);
                    },

                ],
            ],
        ],
    ]); ?>

        </div><!-- /.box-body -->
    </div><!-- /.box -->

</div>
