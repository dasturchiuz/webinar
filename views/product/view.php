<?php
use yii\widgets\ActiveForm;
use halumein\wishlist\widgets\WishlistButton;
use yii\helpers\Html;
use \yii2mod\rating\StarRating;
use yii\helpers\Url;
$this->title=$model->name;
$data_categor=array_reverse(app\models\Category::getCat($model->category_id));
foreach($data_categor as $item){
    $this->params['breadcrumbs'][] = ['label' => $item['name'], 'url' => ['/product/category/'. $item['slug']]];
}

$this->params['breadcrumbs'][] = $this->title;
//$this->registerJsFile(
//    '@web/js/InputSpinner.js',
//    ['depends' => [\yii\web\JqueryAsset::className()]]
//);

$this->registerJs("$(document).ready(function(){
$('#qty').prop('disabled', true);
$('#plus-btn').click(function(){
    $('#qty').val(parseInt($('#qty').val()) + 1 );
});
$('#minus-btn').click(function(){
    $('#qty').val(parseInt($('#qty').val()) - 1 );
    if ($('#qty').val() == 0) {
        $('#qty').val(1);
    }

});
});");
?>

<!-- ========================= SECTION MAIN ========================= -->
<section class="section-main  padding-top-sm">
    <div class="container">


        <?=
        yii\widgets\Breadcrumbs::widget([
            'itemTemplate'=>'<li class="breadcrumb-item">{link}</li>',
            'activeItemTemplate'=>"<li class=\"breadcrumb-item active\">{link}</li>\n",
            'homeLink' => [
                'label' => Yii::t('yii', 'Главная'),
                'url' => Yii::$app->homeUrl,
            ],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ])
        ?>
        <div class="card">

            <?php if(Yii::$app->session->hasFlash('success')):?>
                <div class="row">
                    <div class="col">
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times; </span></button>
                            <?=Yii::$app->session->getFlash('success');?>
                        </div>
                    </div>
                </div>
            <?php endif;?>
            <?php if(Yii::$app->session->hasFlash('error')):?>
                <div class="row">
                    <div class="col">
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times; </span></button>
                            <?=Yii::$app->session->getFlash('error');?>
                        </div>
                    </div>
                </div>
            <?php endif;?>


            <div class="row">
                <aside class="col-sm-5 border-right">
                    <?php $mainimg=$model->getImage();?>
                    <?php $gallerys=$model->getImages();?>
                    <article class="gallery-wrap">
                        <div class="img-big-wrap">
                            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <?php $ii=0; foreach($gallerys as $item_image):?>
                                        <div class="carousel-item  <?php if($ii==0) echo "active";?>" data-slide-to="<?=$ii?>">
                                            <a href="<?= $item_image->getUrl(); ?>" data-fancybox><img class="d-block " src="<?= $item_image->getUrl(); ?>" alt="<?=$ii?>" ></a>
                                        </div>
                                    <?php $ii++; endforeach;?>
                                </div>

                            </div>

                        </div>
                        <div class="img-small-wrap">
                            <?php $ii=0; foreach($gallerys as $item_image):?>
                                <div class="item-gallery "> <img class="itemimg" data-id="<?=$ii?>" src="<?= $item_image->getUrl("60x"); ?>"></div>
                            <?php $ii++; endforeach;?>
                        </div> <!-- slider-nav.// -->
                    </article> <!-- gallery-wrap .end// -->
                </aside>
                <aside class="col-sm-7">
                    <article class="card-body-lg">
                        <h3 class="title mb-3"><?=$model->name;?></h3>

                        <div class="price-detail-wrap">



                                <?php if($model->withdiscost!=false):?>
                                    <var class="price h3 text-warning">
                                        <span class="num"><?=number_format($model->withdiscost, 0, ',', ' ')?></span><span class="currency"> <?=Yii::t('app', 'СУМ');?></span>
                                    </var>
                                    <br>

                                    <var class="price h3 text-warning" style="text-decoration: line-through;

    color: #ca0828;">
                                        <span class="num"><?=number_format($model->cost, 0, ',', ' ')?></span><span class="currency"> <?=Yii::t('app', 'СУМ');?></span>
                                    </var>
                                    <?php else:?>
                                    <?php if($model->old_price!=0):?>
                                    <p class="mb-0  ">
                                        <?=Yii::t('app', 'Cтарая цена: ');?> <var class="price h3 text-warning" style="text-decoration: line-through;color: #ca0828;font-size: 18px;">
                                            <span class="num"><?=number_format($model->old_price, 0, ',', ' ')?></span><span class="currency"> <?=Yii::t('app', 'СУМ');?></span>
                                        </var>
                                    </p>
                                    <?php endif;?>
                                    <p class="mb-0">
                                        <?=Yii::t('app', 'Цена: ');?>
                                        <var class="price h3 text-warning">
                                            <span class="num"><?=number_format($model->cost, 0, ',', ' ')?></span><span class="currency"> <?=Yii::t('app', 'СУМ');?></span>
                                        </var>
                                    </p>
                                    <?php if($model->wholesale_price!=0):?>
                                    <p class="mb-0">
                                        <?=Yii::t('app', 'Цена оптом: ');?>
                                        <var class="price h3 text-warning">
                                            <span class="num"><?=number_format($model->wholesalePrice, 0, ',', ' ')?></span><span class="currency"> <?=Yii::t('app', 'сум');?> от <?=$model->wholesale_count?>  <?=$model->unit->unit_name?>.</span>
                                        </var>

                                    </p>
                                        <?php endif;?>


                                        <?php endif;?>


                            <span> <?php //if($model->unit!=null) echo "/ ".$model->unit->unit_name;?></span>

                        </div> <!-- price-detail-wrap .// -->

                        <dl class="item-property">
                            <dt><?=Yii::t('app', 'Описание');?></dt>
                            <dd><p><?= $model->short_text; ?> </p></dd>
                        </dl>
                        <?php
                        if($model->useradd!=null):?>

                        <dl class="item-property">
                            <p><?=Yii::t('app', 'Продовец:');?>  <a style="text-decoration: underline;font-weight: 700;" href="<?=Url::toRoute(['shop/'.$model->useradd->name_magazin])?>"><?= $model->useradd->name_magazin; ?> </a></p>
                        </dl>
                        <?php endif;?>
                        <dl class="item-property">
                            <p><?=Yii::t('app', 'Код товар:');?> <?= $model->id; ?> </a></p>
                        </dl>
                        <?php foreach($model->getAttrproducts()->where(['is_main'=>1])->all() as $itemattr): ?>

                        <dl class="param param-feature" style="
    display: block;
">
                            <dt><?=$itemattr->attr_name?></dt>
                            <dd><?=$itemattr->attr_value?></dd>
                        </dl>  <!-- item-property-hor .// -->
                        <?php endforeach;?>

                            <br>
                        <div class="rating-wrap">
                            <div class="stars-wrap">
                                <ul class="list-rating">
                                    <li style="width:<?=$model->star*20?>%"class="stars-active">
                                        <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </li>
                                    <li>
                                        <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </li>
                                </ul>
                                <?=number_format($model->star, 1, '.', ' ')?>
                            </div>
                            <div class="label-rating">Отзывы <?=$model->getReviews()->count();?></div>
<!--                            <div class="label-rating">154 orders </div>-->
                        </div> <!-- rating-wrap.// -->
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <?=Yii::t('app', "Количество: ")?>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-dark btn-sm" id="minus-btn"><i class="fa fa-minus"></i></button>
                                    </div>
                                    <input type="number" id="qty" class="form-control form-control-sm" value="1" min="1">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-dark btn-sm" id="plus-btn"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">

                            </div>
                            <div class="col-sm-5"></div>
                        </div>
                        <a href data-toggle="modal" data-target="#return_guarantee"><?=Yii::t('app', 'Гарантия возврата');?></a>
                        <hr>
                        <a class="btn btn-lg btn-primary text-uppercase add-to-cart" data-id="<?= $model->id; ?>"> <i class="fas fa-shopping-cart"></i> Добавить в корзину </a>
                        <?= WishlistButton::widget([
                            'model' => $model, // модель для добавления
                            'anchorActive' => 'Удалить товар из избранного', // свой текст активной кнопки
                            'anchorUnactive' => ' Добавить товар в избранное', // свой текст неактивной кнопки
                            'htmlTag' => 'a', // тэг
                            'cssClass' => 'btnfovrite', // свой класс
                            'cssClassInList' => 'unfovrite' // свой класс для добавленного объекта
                        ]) ?>
                        <?php if(\app\models\User::isSuperadmin() || \app\models\User::isAdmin() || \app\models\User::isManager() || \app\models\User::isRegman()):?>

                            <a class="btn btn-lg btn-primary text-uppercase" href="<?=Url::toRoute(['administration/product/update', 'id' => $model->id])?>"> <i class="fas fa-edit"></i> Редактировать </a>

                        <?php endif;?>
                    </article> <!-- card-body.// -->
                </aside> <!-- col.// -->
            </div>
            <div class="row">
                <aside class="col-sm-12 ">

                    <div class="container border-top pb-5" id="product-proporties">
                        <h3 class="mt-4 mb-3"><?=Yii::t('app', 'Об этом товаре')?></h3>

                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"><i class="icon fas fa-file-alt"></i> Описание  </a>
                                <a class="nav-item nav-link" id="nav-xarakteristika-tab" data-toggle="tab" href="#nav-xarakteristika" role="tab" aria-controls="nav-xarakteristika" aria-selected="false"><i class="icon fas fa-info-circle"></i> Дополнительная информация   </a>
                                <a class="nav-item nav-link" id="nav-reviews-tab" data-toggle="tab" href="#nav-reviews" role="tab" aria-controls="nav-reviews" aria-selected="false"><i class="icon fas fa-star"></i> Отзывы (<?=$model->getReviews()->count();?>) </a>
                            </div>
                        </nav>
                        <div class="tab-content pt-2" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <p></p>
                                <h1 class="title p-b-15 title--lg" style="box-sizing: border-box; margin: 0px; padding: 0px 0px 15px; outline: 0px; -webkit-tap-highlight-color: transparent; font-size: 24px; color: #242424; font-family: LatoRegular, sans-serif;">
                                    <?=$model->name;?>
                                </h1>
                                <p><?= $model->text; ?> </p>
                            </div>
                            <div class="tab-pane fade" id="nav-xarakteristika" role="tabpanel" aria-labelledby="nav-xarakteristika-tab">
                                <table class="proporties">
                                    <tbody>
                                    <?php foreach($model->attrproducts as $itemattr): ?>
                                        <?php if($itemattr->is_group==1):?>
                                            <tr class="mt-2">
                                                <td colspan="2">
                                                   <h4 class="mt-3 mb-0"><?=$itemattr->attr_name?></h4>
                                                </td>
                                            </tr>

                                        <?php else:?>
                                            <tr>
                                                <td>
                                                    <?=$itemattr->attr_name?>
                                                </td>
                                                <td>
                                                    <?=$itemattr->attr_value?>
                                                </td>
                                            </tr>
                                        <?php endif;?>
                                    <?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="nav-reviews" role="tabpanel" aria-labelledby="nav-reviews-tab">
                                <?php $form=ActiveForm::begin();?>
                                <h3>Написать отзыв</h3>

                                <?=$form->field($otziv, 'star_rating')->widget(StarRating::class, [
                                    'options' => [

                                    ],
                                    'clientOptions' => [

                                    ],
                                ]);?>

                                        <?=$form->field($otziv, 'otziv_text')->textarea();?>
                                    <div class="form-group">
                                        <?=Html::submitButton('Отправить', ['class'=>'btn btn-primary'])?>

                                    </div>
                                <?php ActiveForm::end();?>
                                <h3>Отзывы</h3>
                                <?=yii\widgets\ListView::widget([
                                    'dataProvider'=>$dataReviewsProvider,
                                    'pager' => [
                                        'pagination'=> [
                                            'pageSize' => 3,

                                        ]
                                    ],
                                    'layout' => "\n

                                {items}
                            ",
                                    'itemView'=>function($model, $key, $index, $widget){
                                        return $this->render('_review', ['model'=>$model]);
                                    }
                                ]);?>

                            </div>
                        </div>
                    </div>


                </aside>
            </div>
        </div>
    </div>
</section>
<div id="return_guarantee" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?=Yii::t('app', 'Гарантия возврата');?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?=$model->return_guarantee?>
            </div>

        </div>

    </div>
</div>
