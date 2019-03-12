<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\HtmlPuriFier;
?>
<div class="item col-md-3" data-key="<?= $model->id; ?>">

    <figure class="card card-product">
        <?php if($model->costdiscount!=false):?>
        <span class="badge-offer"><b> - <?php echo $model->costdiscount["price_procent"]?>%</b></span>
    <?php endif;?>
        <div class="img-wrap">
            <a href="<?=Url::to(['product/'.$model->slug, ])?>">
            <img src="<?= $model->getImage()->getUrl("200x"); ?>">
            </a>
            <a class="btn-overlay quikview" data-id="<?=$model->id;?>" href="#"><i class="fa fa-search-plus"></i> <?=Yii::t('app', 'Просмотр товара');?></a>
        </div>
        <figcaption class="info-wrap">
            <h6 class="title text-dots"><a href="<?=Url::to(['product/'.$model->slug, ])?>"><?=$model->name;?></a></h6>
            <div class="action-wrap">
                <div class="price-wrap h5">
                <?php if($model->withdiscost!=false):?>
                    <span class="price-new"><?=number_format($model->withdiscost, 0, ',', ' ')?> <?=Yii::t('app', 'сум');?></span>
                    <br>
                    <span class="price-old text-muted" style="text-decoration: line-through;"><?=number_format($model->cost, 0, ',', ' ')?> <?=Yii::t('app', 'сум');?></span>

                <?php else:?>
                    <span class="price-new"><?=number_format($model->cost, 0, ',', ' ')?> <?=Yii::t('app', 'сум');?></span>
                <?php endif;?>
                </div>
            </div>
            <div class="action-wrap text-center">
                <a data-id="<?=$model->id;?>"  class="btn btn-primary btn-sm   add-to-cart"> Добавить в корзину </a>

            </div>
        </figcaption>
    </figure>
</div>
<?=($index+1)%4==0 ? '<div class="w-100"></div>' : '';?>