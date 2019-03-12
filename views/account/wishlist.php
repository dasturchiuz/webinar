<?php
use yii\widgets\DetailView;
use yii\helpers\Html;
use yii\helpers\Url;
$this->title="Мои желания";
?>
<!-- ========================= SECTION MAIN ========================= -->
<section class="section-main bg padding-top-sm">
    <div class="container">


        <div class="row">

            <aside class="col-sm-9">
                <div class="card">
                    <article class="card-body">
                        <h4 class="title mb-4">Мои желания</h4>
                        <hr>
                        <div class="row mt-3">

                            <aside class="col-sm-8">
                                <article class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <th>Код продукт</th>
                                            <th>Название продукта</th>
                                            <th>Цена</th>
                                        </thead>
                                        <tbody>
                                        <?php foreach(\Yii::$app->wishlist->getUserWishList() as $fovrite):?>
                                            <tr>
                                                <td><?=$fovrite->id?></td>
                                                <td><?=Html::a($fovrite->name, ['product/'.$fovrite->slug]);?></td>
                                                <td><?=$fovrite->price?></td>
                                            </tr>
                                        <?php endforeach;?>

                                        </tbody>
                                    </table>

                                </article> <!-- card-body.// -->
                            </aside> <!-- col.// -->

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



