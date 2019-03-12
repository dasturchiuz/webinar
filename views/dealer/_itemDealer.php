<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\HtmlPuriFier;
?>
<article class="card card-product">
    <div class="card-body">
        <div class="row">
            <aside class="col-sm-4">
                <div class="img-wrap">
                    <?=Html::a(Html::img(Url::to(['/dealer/logo/', 'magazin_id'=>$model->user_id]), []), ['/shop/'.$model->useradd->name_magazin],[])?>
                </div>
            </aside> <!-- col.// -->
            <article class="col-sm-8">

                <h4 class="title"> <?=Html::a($model->useradd->name_magazin, ['/shop/'.$model->useradd->name_magazin],[])?>  </h4>
                <?=$model->useradd->star;?>
                <div class="rating-wrap">
                    <div class="stars-wrap">
                        <ul class="list-rating">
                            <li style="width:<?=$model->useradd->star!=null ? $model->useradd->star : 0 ;?>%"class="stars-active">
                                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </li>
                            <li>
                                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </li>
                        </ul> &nbsp;
                        <?=number_format($model->useradd->star, 1, '.', ' ')?>

                    </div>
                    <div class="label-rating">Отзывы <?=$model->useradd->starCount;?></div>
                    <!--                            <div class="label-rating">154 orders </div>-->
                </div> <!-- rating-wrap.// -->
                <p><i class="fas fa-map-marker-alt"></i> <?=$model->useradd->oblast->name_obl?></p>
                <p><i class="fas fa-phone"></i> <?=$model->useradd->tell?></p>
                <p>Этот магазин работает с <strong><?=date('d.m.Y', $model->useradd->created_at);?></strong>
                </p>
                <?= \dasturchiuz\chatroom\SendMessage::widget(['receiverID'=>$model->useradd->user_id, 'txtclass'=>'text-info text-left', 'txt'=>'Отправить сообщение']); ?>
                <p><?=Html::a('<i class="fas fa-angle-down"></i> Покупаю', ['/shop/'.$model->useradd->name_magazin.'/buy'], ['class'=>'text-primary'])?>  <?=Html::a('<i class="fas fa-angle-up"></i> Продаю', ['/shop/'.$model->useradd->name_magazin."/sell"], ['class'=>'text-danger'])?></p>
            </article> <!-- col.// -->

        </div> <!-- row.// -->
    </div> <!-- card-body .// -->
</article> <!-- product-list.// -->
