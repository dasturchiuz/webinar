<?php
use yii\widgets\DetailView;
use yii\helpers\Html;
use yii\helpers\Url;
$this->title="Центр пользователя";
?>
<!-- ========================= SECTION MAIN ========================= -->
<section class="section-main bg padding-top-sm">
    <div class="container">


            <div class="row">

                <aside class="col-sm-9">
                    <div class="card">
                    <article class="card-body">
                        <h4 class="title mb-4">Центр пользователя - <span class="text-primary"><?=Html::encode($model->usernameid);?></span></h4>
                        <hr>



                        <div class="row mt-3">
                            <?php if(Yii::$app->user->can('client_juridical')): ?>
                            <div class="col">
                                <a href="<?=Url::to(['account/products']);?>" class="text-center text-primary">
                                    <h1 class="mb-3"><i class="fas fa-tags display-4"></i></h1>
                                    <h6>Мои товары</h6>
                                </a>
                            </div>
                            <?php endif;?>

                            <div class="col">
                                <a href="<?=Url::to(['account/orders']);?>" class="text-center text-primary">
                                    <h1 class="mb-3"><i class="fas fa-file-alt display-4"></i></h1>
                                    <h6>Все заказы</h6>
                                </a>
                            </div>

                            <div class="col">
                                <a href="<?=Url::to(['account/profile']);?>" class="text-center text-primary">
                                    <h1 class="mb-3"><i class="fas fa-user display-4"></i></h1>
                                    <h6>Личная информация</h6>
                                </a>
                            </div>
                            <div class="col">
                                <a href="<?=Url::to(['account/address']);?>" class="text-center text-primary">
                                    <h1 class="mb-3"><i class="fas fa-map-marker-alt display-4"></i></h1>
                                    <h6>Мой адрес</h6>
                                </a>
                            </div>
                            <div class="col">
                                <a href="<?=Url::to(['account/comment']);?>" class="text-center text-primary">
                                    <h1 class="mb-3"><i class="fas fa-comments display-4"></i></h1>
                                    <h6>Оценка продукта</h6>
                                </a>
                            </div>
                            <div class="col">
                                <a href="<?=Url::to(['account/wishlist']);?>" class="text-center text-primary">
                                    <h1 class="mb-3"><i class="far fa-heart display-4"></i></h1>
                                    <h6>Мои желания</h6>
                                </a>
                            </div>

                            <div class="col">
                                <a href="<?=Url::to(['account/change-password']);?>" class="text-center text-primary">
                                    <h1 class="mb-3"><i class="fas fa-key display-4"></i></h1>
                                    <h6>Изменить пароль</h6>
                                </a>
                            </div>




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



