
<!-- ========================= SECTION MAIN ========================= -->
<section class="section-main bg padding-top-sm">
    <div class="container">

        <div class="row row-sm">
            <aside class="col-md-3">

                <?= $this->render(
                    'category.php',
                    ['directoryAsset' => $directoryAsset]
                ) ?>
            </aside> <!-- col.// -->
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">

                        <?= Yii::$app->session->getFlash('success');?>
                        <!-- ================= main slide ================= -->
                        <div class="owl-init slider-main owl-carousel" data-items="1" data-dots="false">
                            <div class="item-slide">
                                <img src="images/banners/slide1.jpg">
                            </div>
                            <div class="item-slide">
                                <img src="images/banners/slide2.jpg">
                            </div>
                            <div class="item-slide">
                                <img src="images/banners/slide3.jpg">
                            </div>
                        </div>
                        <!-- ============== main slidesow .end // ============= -->
                    </div> <!-- card-body .// -->
                </div> <!-- card.// -->
            </div> <!-- col.// -->
            <aside class="col-md-2">

                <div class="card">
                    <figure class="itemside has-bg">
                        <img class="img-bg opacity" src="images/items/item-sm.png">
                        <figcaption class="card-body">
                            <h6 class="title">Group of products <br> is here </h6>
                            <a href="#" class="small">More items</a>
                        </figcaption>
                    </figure>
                </div> <!-- card.// -->

                <div class="card">
                    <figure class="itemside has-bg">
                        <img class="img-bg opacity" src="images/items/1.jpg">
                        <figcaption class="card-body">
                            <h6 class="title">Group of products <br> is here </h6>
                            <a href="#" class="small">More items</a>
                        </figcaption>
                    </figure>
                </div> <!-- card.// -->

                <div class="card">
                    <figure class="itemside has-bg">
                        <img class="img-bg opacity" src="images/items/2.jpg">
                        <figcaption class="card-body">
                            <h6 class="title">Group of products <br> is here </h6>
                            <a href="#" class="small">More items</a>
                        </figcaption>
                    </figure>
                </div> <!-- card.// -->

            </aside>
        </div>
    </div> <!-- container .//  -->
</section>
<!-- ========================= SECTION MAIN END// ========================= -->

<!-- ========================= SECTION PRODUCTS ========================= -->
<?= $this->render('latestproducts', [
    'productmodel'=>$productmodel,
    'directoryAsset'=>$directoryAsset,

]);?>
<!-- ========================= SECTION PRODUCTS END// ========================= -->

<!-- ========================= SECTION FEATURED ========================= -->
<section class="section-request bg padding-top-sm">
    <div class="container">
        <header class="section-heading heading-line bg">
            <h2 class="title-section">Представленные продукты</h2>
        </header><!-- sect-heading -->

        <div class="row row-sm mb-4">
            <div class="col-md-8">
                <figure class="card border-0 card-banner">
                    <figcaption class="caption-left">
                        <br>
                        <h2>Big boundle or collection of featured items</h2>
                        <br>
                        <a class="btn btn-warning" href="#">Detail info » </a>
                    </figcaption>
                    <div class="img-wrap"><img src="images/banners/banner-request.jpg"></div>
                </figure>
            </div> <!-- col // -->
            <div class="col-md-4">

                <div class="card border-0">
                    <figure class="itemside">
                        <div class="aside">
                            <div class="img-wrap bg-warning">
                                <i class="fa-3x fa fa-users white center-xy"></i>
                            </div>
                        </div>
                        <figcaption class="text-wrap">
                            <h6 class="title  mt-3">One request, many offers </h6>
                            <a href="#">View addresses</a>
                        </figcaption>
                    </figure>
                </div> <!-- card.// -->

                <div class="card border-0">
                    <figure class="itemside">
                        <div class="aside">
                            <div class="img-wrap bg-warning">
                                <i class="fa-3x fa fa-university white center-xy"></i>
                            </div>
                        </div>
                        <figcaption class="text-wrap">
                            <h6 class="title mt-3">Our branches and showrooms</h6>
                            <a href="#">View addresses</a>
                        </figcaption>
                    </figure>
                </div> <!-- card.// -->

                <div class="card border-0">
                    <figure class="itemside">
                        <div class="aside">
                            <div class="img-wrap bg-warning">
                                <i class="fa-3x fa fa-file-pdf white center-xy"></i>
                            </div>
                        </div>
                        <figcaption class="text-wrap">
                            <h6 class="title mt-3">Check our catalog</h6>
                            <a href="#">Download file</a>
                        </figcaption>
                    </figure>
                </div> <!-- card.// -->

            </div> <!-- col // -->
        </div><!-- row // -->

    </div><!-- container // -->
</section>
<!-- ========================= SECTION FEATURED END .// ========================= -->

<section class="section-links padding-top">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <header class="section-heading">
                    <h2 class="title-section">Поставщики по регионам</h2>
                </header><!-- sect-heading -->
                <ul class="list-icon row">
                    <li class="col-md-4"><a href="#"><span>Ташкент</span></a></li>
                    <li class="col-md-4"><a href="#"><span>Самарканд</span></a></li>
                    <li class="col-md-4"><a href="#"><span>Джизак</span></a></li>
                    <li class="col-md-4"><a href="#"><span>Фергана</span></a></li>
                    <li class="col-md-4"><a href="#"><span>Андижан</span></a></li>
                    <li class="col-md-4"><a href="#"> <span>Больше регионов</span></a></li>
                </ul>
            </div> <!-- col // -->
            <div class="col-md-12">
                <header class="section-heading">
                    <h2 class="title-section">Наши торговые услуги </h2>
                </header><!-- sect-heading -->
                <ul class="list-icon row">
                    <li class="col-md-5"><a href="#"><i class="icon fa fa-shopping-cart"></i><span>Торговое содействие</span></a></li>
                    <li class="col-md-5"><a href="#"><i class="icon fa fa-briefcase"></i><span>Бизнес-идентификация</span></a></li>
                    <li class="col-md-5"><a href="#"><i class="icon fa fa-plane"></i><span>Доставка по всему Узбекистану</span></a></li>
                    <li class="col-md-5"><a href="#"><i class="icon fa fa-phone"></i><span>Служба поддержки</span></a></li>
                    <li class="col-md-5"><a href="#"><i class="icon fa fa-lock"></i><span>Обеспеченный платеж</span></a></li>
                    <li class="col-md-5"><a href="#"><i class="icon fa fa-bars"></i> <span>Другие услуги</span></a></li>
                </ul>
            </div> <!-- col // -->
        </div><!-- row // -->
        <br>
    </div><!-- container // -->
</section>