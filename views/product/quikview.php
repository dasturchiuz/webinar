<?php
use yii\helpers\Html;

?>
<div class="row">
    <aside class="col-sm-6 border-right">
        <?php $mainimg=$model->getImage();?>
        <?php $gallerys=$model->getImages();?>
        <article class="gallery-wrap">
            <div class="img-big-wrap">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <?php $ii=0; foreach($gallerys as $item_image):?>
                            <div class="carousel-item  <?php if($ii==0) echo "active";?>" data-slide-to="<?=$ii?>">
                                <a href="<?= $item_image->getUrl(); ?>" data-fancybox><img class="d-block w-100" src="<?= $item_image->getUrl(); ?>" alt="<?=$ii?>" ></a>
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
    <aside class="col-sm-6">

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
                    <var class="price h3 text-warning">
                        <span class="num"><?=number_format($model->cost, 0, ',', ' ')?></span><span class="currency"> <?=Yii::t('app', 'СУМ');?></span>
                    </var>
                <?php endif;?>
                <span> <?php if($model->unit!=null) echo "/ ".$model->unit->unit_name;?></span>
            </div> <!-- price-detail-wrap .// -->

            <dl class="item-property">
                <dt><?=Yii::t('app', 'Описание')?></dt>
                <dd><p><?= $model->short_text; ?> </p></dd>
            </dl>
            <?php foreach($model->getAttrproducts()->where(['is_main'=>1])->all() as $itemattr): ?>

                <dl class="param param-feature" style="
    display: block;
">
                    <dt><?=$itemattr->attr_name?></dt>
                    <dd><?=$itemattr->attr_value?></dd>
                </dl>  <!-- item-property-hor .// -->
            <?php endforeach;?>


            <hr>
            <a class="btn btn-lg btn-primary text-uppercase add-to-cart" data-id="<?= $model->id; ?>"> <i class="fas fa-shopping-cart"></i> Добавить в корзину </a>
        </article> <!-- card-body.// -->
    </aside> <!-- col.// -->
</div>