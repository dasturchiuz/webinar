<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\HtmlPuriFier;
?>
<?php if($model->type_ads == \app\models\Product::PRODUCT_TYPEAD_PRADAYU){
    $url_='sell';

}
if($model->type_ads == \app\models\Product::PRODUCT_TYPEAD_PAKUPAYU){
    $url_='buy';

}
?>
    <div class="item col-md-3" data-key="<?= $model->product->id; ?>">

        <figure class="card card-product">
            <?php if($model->product->costdiscount!=false):?>
                <span class="badge-offer"><b> - <?php echo $model->product->costdiscount["price_procent"]?>%</b></span>
            <?php endif;?>
            <div class="img-wrap">
                <a href="<?=Url::to(['/shop/'.$model->product->useradd->name_magazin .'/'. $url_.'/'.$model->product->slug, ])?>">
                    <img src="<?= $model->product->getImage()->getUrl("200x"); ?>">
                </a>
                <a class="btn-overlay quikview" data-id="<?=$model->product->id;?>" href="#"><i class="fa fa-search-plus"></i> <?=Yii::t('app', 'Просмотр товара');?></a>
            </div>
            <figcaption class="info-wrap">

                <h6 class="title text-dots"><a href="<?=Url::to(['/shop/'.$model->product->useradd->name_magazin .'/'. $url_.'/'.$model->product->slug, ])?>"><?=$model->product->name;?></a></h6>
                <div class="action-wrap">
                    <div class="price-wrap h5">
                        <?=number_format($model->price_ads, 0, ',', ' ')?> <?=Yii::t('app', 'сум');?>
                    </div>
                </div>

            </figcaption>
        </figure>
    </div>
<?=($index+1)%4==0 ? '<div class="w-100"></div>' : '';?>