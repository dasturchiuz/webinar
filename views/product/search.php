<?php
$this->title="Поиск"
?>
<!-- ========================= SECTION MAIN ========================= -->
<section class="section-main  padding-top-sm">
    <div class="container">
        <?php if(Yii::$app->session->hasFlash('error')):?>
            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Error</h4>
                <p><?=Yii::$app->session->getFlash('error')?></p>

            </div>

        <?php endif;?>

        <?php if(Yii::$app->session->hasFlash('success')):?>
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Success</h4>
                <p><?=Yii::$app->session->getFlash('success')?></p>

            </div>

        <?php endif;?>
        <div class="row row-sm mb-3">
            <aside class="col-md-3">
                <?php  $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/views/product/');?>
                <?= $this->render(
                    'category.php',
                    ['directoryAsset' => $directoryAsset]
                ) ?>
            </aside> <!-- col.// -->

            <div class="col-md-7">
                <div id="carousel1_indicator" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carousel1_indicator" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel1_indicator" data-slide-to="1" class=""></li>
                        <li data-target="#carousel1_indicator" data-slide-to="2" class=""></li>
                        <li data-target="#carousel1_indicator" data-slide-to="3" class=""></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="<?=Yii::getAlias('@web');?>/images/partnerka_2.jpg" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="<?=Yii::getAlias('@web');?>/images/dostavka_1.jpg" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="<?=Yii::getAlias('@web');?>/images/dostavka-novaya_4.jpg" alt="First slide">
                        </div>

                        <div class="carousel-item">
                            <img class="d-block w-100" src="<?=Yii::getAlias('@web');?>/images/bez-imeni-1.jpg" alt="Second slide">
                        </div>

                    </div>
                    <a class="carousel-control-prev" href="#carousel1_indicator" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carousel1_indicator" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="col-md-2">
                <div class="no-gutters">
                    <div class="col">
                        <img class="d-block w-100" src="<?=Yii::getAlias('@web');?>/images/dostavka_1.jpg" alt="First slide">

                    </div>
                </div>
                <div class="no-gutters mt-3">
                    <div class="col">
                        <img class="d-block w-100" src="<?=Yii::getAlias('@web');?>/images/partnerka_2.jpg" alt="First slide">

                    </div>
                </div>
                <div class="no-gutters  mt-3">
                    <div class="col">
                        <img class="d-block w-100" src="<?=Yii::getAlias('@web');?>/images/dostavka-novaya_4.jpg" alt="First slide">

                    </div>
                </div>



            </div>

        </div>
        <div class="row row-sm">
            <?=yii\widgets\ListView::widget([
                'dataProvider'=>$dataProvider,


                'layout' => "\n
                            <div class='row'>
                                {items}
                            </div>\n",
                'summary'=>"<div>".Yii::t('app', "Тавары")." {begin} - {end} ".Yii::t('app', "из")." {totalCount} </div>",
                'itemView' => function ($model, $key, $index, $widget) {
                    return $this->render('_item',['model' => $model, 'index'=>$index]);

                    // or just do some echo
                    // return $model->title . ' posted by ' . $model->author;
                },
                'emptyText'=>"<h3>Результатов не найдено.</h3>",
                'itemOptions' => [
                    'tag' => false,
                ],
                'options' => [
                    'tag' => 'div',
                    'class' => 'container',
                    'id' => 'cont',
                ],
            ]);?>


        </div>
        <hr>
        <!--        <div class="row row-sm">-->
        <!--            -->
        <!--            <div class="owl-carousel slide-items" data-items="4" data-margin="20" data-dots="true" data-nav="true">-->
        <!--                <div class="item-slide">-->
        <!--                        <figure class="card card-product">-->
        <!--                            <div class="img-wrap">-->
        <!--                                <a href="/product/apple-iphone-7-128gb-black">-->
        <!--                                    <img src="/13/images/image-by-item-and-alias?item=Product11&amp;dirtyAlias=fa484f47c3-1.jpg">-->
        <!--                                </a>-->
        <!--                                <a class="btn-overlay quikview" data-id="11" href="#"><i class="fa fa-search-plus"></i> Просмотр товара</a>-->
        <!--                            </div>-->
        <!--                            <figcaption class="info-wrap">-->
        <!--                                <h6 class="title text-dots"><a href="/product/apple-iphone-7-128gb-black">Apple iPhone 7 128GB Black</a></h6>-->
        <!--                                <div class="action-wrap">-->
        <!--                                    <div class="price-wrap h5">-->
        <!--                                        <span class="price-new">525 000 сум</span>-->
        <!--                                    </div>-->
        <!--                                </div>-->
        <!--                                <div class="action-wrap text-center">-->
        <!--                                    <a data-id="11" class="btn btn-primary btn-sm   add-to-cart"> Добавить в корзину </a>-->
        <!---->
        <!--                                </div>-->
        <!--                            </figcaption>-->
        <!--                        </figure>-->
        <!--                </div>-->
        <!--<div class="item-slide">-->
        <!--                        <figure class="card card-product">-->
        <!--                            <div class="img-wrap">-->
        <!--                                <a href="/product/apple-iphone-7-128gb-black">-->
        <!--                                    <img src="/13/images/image-by-item-and-alias?item=Product11&amp;dirtyAlias=fa484f47c3-1.jpg">-->
        <!--                                </a>-->
        <!--                                <a class="btn-overlay quikview" data-id="11" href="#"><i class="fa fa-search-plus"></i> Просмотр товара</a>-->
        <!--                            </div>-->
        <!--                            <figcaption class="info-wrap">-->
        <!--                                <h6 class="title text-dots"><a href="/product/apple-iphone-7-128gb-black">Apple iPhone 7 128GB Black</a></h6>-->
        <!--                                <div class="action-wrap">-->
        <!--                                    <div class="price-wrap h5">-->
        <!--                                        <span class="price-new">525 000 сум</span>-->
        <!--                                    </div>-->
        <!--                                </div>-->
        <!--                                <div class="action-wrap text-center">-->
        <!--                                    <a data-id="11" class="btn btn-primary btn-sm   add-to-cart"> Добавить в корзину </a>-->
        <!---->
        <!--                                </div>-->
        <!--                            </figcaption>-->
        <!--                        </figure>-->
        <!--                </div>-->
        <!--<div class="item-slide">-->
        <!--                        <figure class="card card-product">-->
        <!--                            <div class="img-wrap">-->
        <!--                                <a href="/product/apple-iphone-7-128gb-black">-->
        <!--                                    <img src="/13/images/image-by-item-and-alias?item=Product11&amp;dirtyAlias=fa484f47c3-1.jpg">-->
        <!--                                </a>-->
        <!--                                <a class="btn-overlay quikview" data-id="11" href="#"><i class="fa fa-search-plus"></i> Просмотр товара</a>-->
        <!--                            </div>-->
        <!--                            <figcaption class="info-wrap">-->
        <!--                                <h6 class="title text-dots"><a href="/product/apple-iphone-7-128gb-black">Apple iPhone 7 128GB Black</a></h6>-->
        <!--                                <div class="action-wrap">-->
        <!--                                    <div class="price-wrap h5">-->
        <!--                                        <span class="price-new">525 000 сум</span>-->
        <!--                                    </div>-->
        <!--                                </div>-->
        <!--                                <div class="action-wrap text-center">-->
        <!--                                    <a data-id="11" class="btn btn-primary btn-sm   add-to-cart"> Добавить в корзину </a>-->
        <!---->
        <!--                                </div>-->
        <!--                            </figcaption>-->
        <!--                        </figure>-->
        <!--                </div>-->
        <!---->
        <!--                <div class="item-slide">-->
        <!--                        <figure class="card card-product">-->
        <!--                            <div class="img-wrap">-->
        <!--                                <a href="/product/apple-iphone-7-128gb-black">-->
        <!--                                    <img src="/13/images/image-by-item-and-alias?item=Product11&amp;dirtyAlias=fa484f47c3-1.jpg">-->
        <!--                                </a>-->
        <!--                                <a class="btn-overlay quikview" data-id="11" href="#"><i class="fa fa-search-plus"></i> Просмотр товара</a>-->
        <!--                            </div>-->
        <!--                            <figcaption class="info-wrap">-->
        <!--                                <h6 class="title text-dots"><a href="/product/apple-iphone-7-128gb-black">Apple iPhone 7 128GB Black</a></h6>-->
        <!--                                <div class="action-wrap">-->
        <!--                                    <div class="price-wrap h5">-->
        <!--                                        <span class="price-new">525 000 сум</span>-->
        <!--                                    </div>-->
        <!--                                </div>-->
        <!--                                <div class="action-wrap text-center">-->
        <!--                                    <a data-id="11" class="btn btn-primary btn-sm   add-to-cart"> Добавить в корзину </a>-->
        <!---->
        <!--                                </div>-->
        <!--                            </figcaption>-->
        <!--                        </figure>-->
        <!--                </div>-->
        <!--<div class="item-slide">-->
        <!--                        <figure class="card card-product">-->
        <!--                            <div class="img-wrap">-->
        <!--                                <a href="/product/apple-iphone-7-128gb-black">-->
        <!--                                    <img src="/13/images/image-by-item-and-alias?item=Product11&amp;dirtyAlias=fa484f47c3-1.jpg">-->
        <!--                                </a>-->
        <!--                                <a class="btn-overlay quikview" data-id="11" href="#"><i class="fa fa-search-plus"></i> Просмотр товара</a>-->
        <!--                            </div>-->
        <!--                            <figcaption class="info-wrap">-->
        <!--                                <h6 class="title text-dots"><a href="/product/apple-iphone-7-128gb-black">Apple iPhone 7 128GB Black</a></h6>-->
        <!--                                <div class="action-wrap">-->
        <!--                                    <div class="price-wrap h5">-->
        <!--                                        <span class="price-new">525 000 сум</span>-->
        <!--                                    </div>-->
        <!--                                </div>-->
        <!--                                <div class="action-wrap text-center">-->
        <!--                                    <a data-id="11" class="btn btn-primary btn-sm   add-to-cart"> Добавить в корзину </a>-->
        <!---->
        <!--                                </div>-->
        <!--                            </figcaption>-->
        <!--                        </figure>-->
        <!--                </div>-->
        <!--<div class="item-slide">-->
        <!--                        <figure class="card card-product">-->
        <!--                            <div class="img-wrap">-->
        <!--                                <a href="/product/apple-iphone-7-128gb-black">-->
        <!--                                    <img src="/13/images/image-by-item-and-alias?item=Product11&amp;dirtyAlias=fa484f47c3-1.jpg">-->
        <!--                                </a>-->
        <!--                                <a class="btn-overlay quikview" data-id="11" href="#"><i class="fa fa-search-plus"></i> Просмотр товара</a>-->
        <!--                            </div>-->
        <!--                            <figcaption class="info-wrap">-->
        <!--                                <h6 class="title text-dots"><a href="/product/apple-iphone-7-128gb-black">Apple iPhone 7 128GB Black</a></h6>-->
        <!--                                <div class="action-wrap">-->
        <!--                                    <div class="price-wrap h5">-->
        <!--                                        <span class="price-new">525 000 сум</span>-->
        <!--                                    </div>-->
        <!--                                </div>-->
        <!--                                <div class="action-wrap text-center">-->
        <!--                                    <a data-id="11" class="btn btn-primary btn-sm   add-to-cart"> Добавить в корзину </a>-->
        <!---->
        <!--                                </div>-->
        <!--                            </figcaption>-->
        <!--                        </figure>-->
        <!--                </div>-->
        <!--<div class="item-slide">-->
        <!--                        <figure class="card card-product">-->
        <!--                            <div class="img-wrap">-->
        <!--                                <a href="/product/apple-iphone-7-128gb-black">-->
        <!--                                    <img src="/13/images/image-by-item-and-alias?item=Product11&amp;dirtyAlias=fa484f47c3-1.jpg">-->
        <!--                                </a>-->
        <!--                                <a class="btn-overlay quikview" data-id="11" href="#"><i class="fa fa-search-plus"></i> Просмотр товара</a>-->
        <!--                            </div>-->
        <!--                            <figcaption class="info-wrap">-->
        <!--                                <h6 class="title text-dots"><a href="/product/apple-iphone-7-128gb-black">Apple iPhone 7 128GB Black</a></h6>-->
        <!--                                <div class="action-wrap">-->
        <!--                                    <div class="price-wrap h5">-->
        <!--                                        <span class="price-new">525 000 сум</span>-->
        <!--                                    </div>-->
        <!--                                </div>-->
        <!--                                <div class="action-wrap text-center">-->
        <!--                                    <a data-id="11" class="btn btn-primary btn-sm   add-to-cart"> Добавить в корзину </a>-->
        <!---->
        <!--                                </div>-->
        <!--                            </figcaption>-->
        <!--                        </figure>-->
        <!--                </div>-->
        <!---->
        <!---->
        <!---->
        <!--            </div>-->
        <!--            -->
        <!---->
        <!---->
        <!---->
        <!---->
        <!---->
        <!--        </div>-->


    </div>

</section>


