<?php

/* @var $this \yii\web\View */
/* @var $content string */

<<<<<<< HEAD
use app\assets\PublicAsset;
use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
=======
use app\widgets\Alert;
use yii\helpers\Html;
>>>>>>> origin/master
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

<<<<<<< HEAD
PublicAsset::register($this);
=======
AppAsset::register($this);
>>>>>>> origin/master
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
<<<<<<< HEAD
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title>Kids Academy</title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div id="preloader"></div>
<?php if(!Yii::$app->user->isGuest) { ?>
<header class="navbar navbar-inverse navbar-fixed-top " role="banner">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="/"><h1 style="font-size: 20px;"><span class="pe-7s-gleam bounce-in"></span> Kids Academy</h1></a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <?php if(!Yii::$app->user->identity->isAdmin):?>
                        <a href="#" style="color: #4591D3; font-weight: bold;">Vebinarga o`tish</a>
                    <?php else: ?>
                        <a href="/admin" style="color: #00b29e; font-weight: bold;">Admin Panel</a>
                    <?php endif; ?>
                </li>
                <li class="dropdown active">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Kurslar <i class="fa fa-chevron-down"></i></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="/site/chess">Shaxmat</a></li>
                        <li><a href="/site/mathematic">Matematika</a></li>
                        <li><a href="/site/mental-arithmetic">Mental Arifmetika</a></li>
                        <li><a href="/site/general-english">General English</a></li>
                        <li><a href="/site/ielts">IELTS</a></li>
                        <div class="hr_linya"></div>
                        <li><a href="/site/offline-videos">Offlayn videolar</a></li>
                        <li><a href="/site/free-materials">Bepul materiallar</a></li>
                    </ul>
                </li>
                <?php if(Yii::$app->user->isGuest):?>
                    <li><a href="<?= Url::toRoute(['/auth/login']) ?>">Kirish <i class="fa fa-sign-in-alt"></i></a></li>
                <?php else: ?>

                <li><a href="/site/contact">Kontakt</a></li>
                <li class="dropdown active">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Kabinet <i class="fa fa-chevron-down"></i></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="/auth/cabinet">Kabinetim</a></li>
                        <div class="hr_linya"></div>
                        <li><a href="/auth/courses">Kurslar</a></li>
                        <div class="hr_linya"></div>
                        <li><a href="/auth/payments">To`lovlar</a></li>
                        <div class="hr_linya"></div>
                        <li><a href="/auth/info-user">Ma'lumotlar</a></li>
                        <li>
                            <?= Html::beginForm(['/auth/logout'], 'post')
                            . Html::submitButton(
                                'CHIQISH (' . Yii::$app->user->identity->name . ')',
                                ['class' => 'btn btn-danger', 'style' => 'width: 100%;']
                            )
                            . Html::endForm() ?>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>


                <li title="O'zbek"><a href="#"><img src="../public/images/uzb_flag.jpg" style="width: 25px;" alt=""></a></li>
                <li title="Русский"><a href="#"><img src="../public/images/rus_flag.png" style="width: 25px;" alt=""></a></li>
            </ul>
        </div>
    </div>
</header><!--/header-->
<?php } else {?>
<header class="navbar navbar-inverse navbar-fixed-top " role="banner">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="/"><h1 style="font-size: 20px;"><span class="pe-7s-gleam bounce-in"></span> Kids Academy</h1></a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/#about-us">Biz haqimizda</a></li>
                <li class="dropdown active">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Kurslar <i class="fa fa-chevron-down"></i></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="/site/chess">Shaxmat</a></li>
                        <li><a href="/site/mathematic">Matematika</a></li>
                        <li><a href="/site/mental-arithmetic">Mental Arifmetika</a></li>
                        <li><a href="/site/general-english">General English</a></li>
                        <li><a href="/site/ielts">IELTS</a></li>
                        <div class="hr_linya"></div>
                        <li><a href="/site/offline-videos">Offlayn videolar</a></li>
                        <li><a href="/site/free-materials">Bepul materiallar</a></li>
                    </ul>
                </li>
                <?php if(Yii::$app->user->isGuest):?>
                    <li><a href="<?= Url::toRoute(['/auth/login']) ?>">Kirish <i class="fa fa-sign-in-alt"></i></a></li>
                <?php else: ?>

                    <li>
                        <?= Html::beginForm(['/auth/logout'], 'post')
                        . Html::submitButton(
                            'LogOut (' . Yii::$app->user->identity->name . ')',
                            ['class' => 'btn btn-link logout', 'style' => 'margin-top: 5px;']
                        )
                        . Html::endForm() ?>
                    </li>
                <?php endif; ?>
                <!--                <li><a href="/site/registration">Ro'yxatdan o'tish</a></li>-->
                <!--                <li title="Login"><a href="/site/login"><i class="fa fa-lock"></i></a></li>-->
                <li><a href="/site/contact">Kontakt</a></li>
                <li title="O'zbek"><a href="#"><img src="../public/images/uzb_flag.jpg" style="width: 25px;" alt=""></a></li>
                <li title="Русский"><a href="#"><img src="../public/images/rus_flag.png" style="width: 25px;" alt=""></a></li>
            </ul>
        </div>
    </div>
</header>
<?php }?>
<?= $content ?>

<!--start footer-->
    <div id="footer-wrapper">
        <section id="bottom" class="">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-6 about-us-widget">
                        <h4>Global Coverage</h4>
                        <p>Was drawing natural fat respect husband. An as noisy an offer drawn blush place. These tried for way joy wrote witty. In mr began music weeks after at begin.</p>
                    </div><!--/.col-md-3-->

                    <div class="col-md-3 col-sm-6">
                        <h4>Company</h4>
                        <div>
                            <ul class="arrow">
                                <li><a href="#">Company Overview</a></li>
                                <li><a href="#">Meet The Team</a></li>
                                <li><a href="#">Our Awesome Partners</a></li>
                                <li><a href="#">Our Services</a></li>
                            </ul>
                        </div>
                    </div><!--/.col-md-3-->

                    <div class="col-md-3 col-sm-6">
                        <h4>Latest Articles</h4>
                        <div>
                            <div class="media">
                                <div class="pull-left">
                                    <img class="widget-img" src="../public/images/portfolio/folio01.jpg" alt="">
                                </div>
                                <div class="media-body">
                                    <span class="media-heading"><a href="#">Blog Post A</a></span>
                                    <small class="muted">Posted 14 April 2014</small>
                                </div>
                            </div>
                            <div class="media">
                                <div class="pull-left">
                                    <img class="widget-img" src="../public/images/portfolio/folio02.jpg" alt="">
                                </div>
                                <div class="media-body">
                                    <span class="media-heading"><a href="#">Blog Post B</a></span>
                                    <small class="muted">Posted 14 April 2014</small>
                                </div>
                            </div>
                        </div>
                    </div><!--/.col-md-3-->

                    <div class="col-md-3 col-sm-6">
                        <h4>Come See Us</h4>
                        <address>
                            <strong>Ace Towers</strong><br>
                            New York Ave,<br>
                            New York, 215648<br>
                            <a href="tel:+998998134077">+998998134077</a>
                        </address>
                    </div> <!--/.col-md-3-->
                </div>
            </div>
        </section><!--/#bottom-->

        <footer id="footer" class="">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        &copy; 2019 <a href="/" title="Kids Academy">Kids Academy</a>.
                    </div>
                    <div class="col-sm-6">
                        <ul class="pull-right">
                            <li><a id="gototop" class="gototop" href="#"><i class="fa fa-chevron-up"></i></a></li><!--#gototop-->
                        </ul>
                    </div>
                </div>
            </div>
        </footer><!--/#footer-->
    </div>

<?php $this->endBody() ?>
=======
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<?= Html::csrfMetaTags() ?>
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
<header class="section-header">
    <nav class="navbar navbar-top navbar-expand-lg navbar-light bg2">
        <div class="container">
            <button class="navbar-toggler  ml-auto" type="button" data-toggle="collapse" data-target="#navbarTop" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTop">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#"> <i class="fa fa-phone"></i> <?=Yii::t('app', "Позвонить нам:");?> +998 (90) 603 90 80</a>
                    </li>


                </ul>
                <ul class="navbar-nav">
                    <?php if(\app\models\User::isBuxgalter() || \app\models\User::isSuperadmin() || \app\models\User::isAdmin() || \app\models\User::isAgent() || \app\models\User::isCourier() || \app\models\User::isManager() || \app\models\User::isRegman()):?>


                    <li><a href="<?=\yii\helpers\Url::toRoute('/administration');?>" class="nav-link">Администраторы</a> </li>
                    <?php endif;?>
                    <?php if(!empty(Yii::$app->user->identity)):?><li><a href="<?=Url::to(['my-shop/messages']);?>"  class="nav-link">Сообщения <?=\dasturchiuz\chatroom\NewMessageCount::widget(['userID'=>Yii::$app->user->identity->id]);?></a></li><?php endif;?>
                    <li><a href="<?=\yii\helpers\Url::toRoute('/dealer');?>" class="nav-link">Дилеры</a> </li>
                    <li><a href="<?=\yii\helpers\Url::toRoute('/cart');?>" class="nav-link">Корзина</a> </li>
                    <li><a href="<?=\yii\helpers\Url::toRoute('/account');?>" class="nav-link">Профиль</a> </li>
                    <li><a href="<?=\yii\helpers\Url::toRoute('/page/contact');?>" class="nav-link">Cвязаться с нами</a> </li>

                </ul> <!-- list-inline //  -->
            </div> <!-- navbar-collapse .// -->
        </div> <!-- container //  -->
    </nav>

    <section class="header-main ">
        <div class="container">
            <div class="row align-items-center">
                <div class=" col-lg-5-24 col-12 col-sm-5">
                    <div class="brand-wrap">
                        <a href="<?=Url::home();?>">
                            <img class="logo" src="<?=Url::home();?>images/logo_alior.jpg">
                        </a>

                    </div> <!-- brand-wrap.// -->
                </div>
                <div class="col-lg-13-24 col-sm-12">
                    <form action="<?= Yii::$app->urlManager->createUrl(['product/search']) ?>" method="GET" class="search-wrap">
                        <div class="input-group w-100">
                            
                            <input type="text" name="keyword" class="form-control" autocomplete="off" style="width:60%;" placeholder="Поиск товаров...">

                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form> <!-- search-wrap .end// -->
                </div> <!-- col.// -->
                <div class="col-lg-6-24 col-sm-8  ">
                    <div class="widgets-wrap d-flex justify-content-end">
                        <div class="widget-header">
                            <?php if(!Yii::$app->user->isGuest):?>
                                <small class="title text-muted"> <?=Yii::$app->user->identity->username;?></small>
                                <div> <a href="<?=\yii\helpers\Url::toRoute('/account');?>">Личный кабинет</a> <span class="dark-transp"> | </span>
                                    <a href="<?=yii\helpers\Url::toRoute('account/logout');?>"> Выход</a></div>
                            <?php else:?>
                                <small class="title text-muted">Добро пожаловать, Гость!</small>
                                <div> <a href="<?=yii\helpers\Url::toRoute('account/login');?>">Войти</a> <span class="dark-transp"> | </span>
                                    <a href="<?=yii\helpers\Url::toRoute('account/signup');?>">Зарегистрироваться </a></div>
                            <?php endif;?>


                        </div>
                        <a href="<?=\yii\helpers\Url::toRoute('cart/index');?>" class="widget-header  pl-2 ml-0">
                            <div class="icontext">
                                <div class="icon-wrap icon-sm round border"><i class="fa fa-shopping-cart"></i></div>
                            </div>
                            <span class="badge badge-pill badge-danger notify" id="car-count"><?php if(!empty($_SESSION['cart'])){ echo count($_SESSION['cart']);} ?></span>
                        </a>
                    </div> <!-- widgets-wrap.// -->
                </div> <!-- col.// -->
            </div> <!-- row.// -->
        </div> <!-- container.// -->
    </section> <!-- header-main .// -->
</header>

<section class="bg2">
    <div class="container">
        <div class="row no-gutters">
            <div class="col-lg-12 mx-auto">
                <nav class="navbar navbar-expand-lg navbar-light" id="yuqori-menu">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav" aria-controls="main_nav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="main_nav">
                        <ul class="navbar-nav">
                            <?php foreach(\app\models\Article::find()->where(['in_menu'=>1])->orderby('sort')->asArray()->all() as $menu_item): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?=Url::toRoute(['/page/'.$menu_item['slug']])?>"> <?=$menu_item['title']?> </a>
                            </li>
                            <?php endforeach;?>

                        </ul>
                    </div> <!-- collapse .// -->
                </nav>
            </div> <!-- col.// -->
        </div> <!-- row.// -->
    </div> <!-- container .// -->
</section>

<?=$content;?>


<!-- ========================= FOOTER ========================= -->
<footer class="section-footer bg-secondary">
    <div class="container">
        <section class="footer-top padding-top">
            <div class="row">
                <aside class="col-md-3  col-md-3 white">
                    <h5 class="title">О НАС</h5>
                    <ul class="list-default">
                        <li> <a href=""></a>
                            <?=Html::a('Пользовательское соглашение ', ['/page/polzovatelskoe-soglashenie'])?>
                        </li>
                        
                        <li> 
                            <?=Html::a(Yii::t('app', 'Коммерческое предложение'), ['/page/kommercheskoe-predlozhenie']);?>                            
                        </li>
                        
                    </ul>
                </aside>

                <aside class="col-md-3 col-md-3 white">
                    <h5 class="title">ПОКУПАТЕЛЯМ</h5>
                    <ul class="list-default">
                        <li> <a href="#"></a>
                            <?=Html::a(Yii::t('app', 'Как купить товар? '), ['/page/kak-kupit-tovar']);?>
                        </li>
                       
                    </ul>
                </aside>
                <aside class="col-md-3 col-md-3 white">
                    <h5 class="title">ПРОДАВЦАМ</h5>
                    <ul class="list-default">
                        <li>
                            <?=Html::a(Yii::t('app', 'Как продать товар?'), ['/page/kak-prodat-tovar']);?>
                        </li>
                       
                    </ul>
                </aside>


                <aside class="col-md-3">
                    <article class="white">
                        <h5 class="title">Контакты</h5>
                        <p>
                            <strong>Телефон: </strong> +998 (90) 603 90 80 <br>
                        </p>

                        <div class="btn-group white">
                            <a class="btn btn-facebook" title="Facebook" target="_blank" href="#"><i class="fab fa-facebook-f  fa-fw"></i></a>
                            <a class="btn btn-instagram" title="Instagram" target="_blank" href="#"><i class="fab fa-instagram  fa-fw"></i></a>
                            <a class="btn btn-youtube" title="Youtube" target="_blank" href="#"><i class="fab fa-youtube  fa-fw"></i></a>
                            <a class="btn btn-twitter" title="Twitter" target="_blank" href="#"><i class="fab fa-twitter  fa-fw"></i></a>
                        </div>
                    </article>
                </aside>
            </div> <!-- row.// -->
            <br>
        </section>
        <section class="footer-bottom row">

            <div class="col-md-12 text-center">
                <p class=" white-transp">
                    Copyright 2018 &copy  ALIOR.uz - Торговая площадка в Узбекистане

                </p>
            </div>
        </section> <!-- //footer-top -->
    </div><!-- //container -->
</footer>
<!-- ========================= FOOTER END // ========================= -->


<?php $this->endBody() ?>
<div id="productmodal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Корзина</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Продолжить покупку</button>
                <a href="<?=Url::to(['/cart/checkout']);?>" class="btn btn-success" >Оформить заказ</a>
                <button type="button" class="btn btn-danger clearcart" id="clearcart">Очистить корзину</button>

            </div>
        </div>

    </div>
</div>

<div id="quikview" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Смотрит товар</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            </div>

        </div>

    </div>
</div>
>>>>>>> origin/master
</body>
</html>
<?php $this->endPage() ?>
