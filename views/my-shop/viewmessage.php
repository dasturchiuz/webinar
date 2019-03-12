<?php

//use yii\widgets\DetailView;
use yii\helpers\Html;
//use yii\helpers\Url;
use yii\grid\GridView;

$this->title = Yii::t('app', 'Мои сообщения');
?>
<!-- ========================= SECTION MAIN ========================= -->
<section class="section-main bg padding-top-sm">
    <div class="container">

        <div class="wait-send-message justify-content-center align-items-center" id="wait-message" style="display: none;">
            <div class="row h-100">
                <div class="col-sm-12 my-auto">
                    <div class="w-25 mx-auto"><div class="lds-css ng-scope"><div style="width:100%;height:100%" class="lds-eclipse"><div></div></div></div></div>
                </div>
            </div>

        </div>

        <div class="row">

            <aside class="col-sm-9">
                <div class="card">
                    <article class="card-body">
                        <h4 class="title mb-4"><?= Html::encode($this->title); ?></h4>

                        <hr>
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
                        <div class="row mt-3">


                            <article class="card-body">

                                <?= \dasturchiuz\chatroom\MessagesReadList::widget(['userID'=>Yii::$app->user->identity->id, 'chatRoom'=>$chat_room, 'clientID'=>$id]); ?>

                            </article> <!-- card-body.// -->


                        </div>

                    </article> <!-- card-body.// -->
                </div>

            </aside> <!-- col.// -->
            <aside class="col-md-3">
                <div class="card">
                    <article class="card-body">
                        <?= Yii::$app->view->render("/account/centerprofile") ?>
                    </article> <!-- card-body.// -->
                </div>

            </aside> <!-- col.// -->

        </div>

    </div>
</section>



