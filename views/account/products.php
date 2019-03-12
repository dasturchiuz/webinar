

<?php
use yii\widgets\DetailView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
$this->title="Мои товары";
?>
<!-- ========================= SECTION MAIN ========================= -->
<section class="section-main bg padding-top-sm">
    <div class="container">


        <div class="row">

            <aside class="col-sm-9">
                <div class="card">
                    <article class="card-body">
                        <h4 class="title mb-4"><?=$this->title?></h4>
                        <hr>
                        <div class=" mt-3">


                                    <?= GridView::widget([
                                        'dataProvider' => $dataProvider,
                                        //'filterModel' => $searchModel,
                                        'layout' => '{items} {pager}',
                                        'columns' => [
                                            ['class' => 'yii\grid\SerialColumn'],
                                            [
                                                'attribute'=>'id',
                                                'label'=>'Код товар'
                                            ],
                                            [
                                                'label'=>'Фото',
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
                                            [
                                                'attribute'=>'name',
                                                'format'=>'html',
                                                'value'=>function($data){
                                                    return Html::a($data->name, ['/product/'.$data->slug]);
                                                }
                                            ],
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


                                        ],
                                    ]); ?>


                        </div>

                    </article> <!-- card-body.// -->
                </div>

            </aside> <!-- col.// -->
            <aside class="col-md-3">
                <div class="card">
                    <article class="card-body">
                        <?=Yii::$app->controller->renderPartial("centerprofile")?>
                    </article> <!-- card-body.// -->
                </div>

            </aside> <!-- col.// -->

        </div>

    </div>
</section>




