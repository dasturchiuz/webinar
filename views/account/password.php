<?php
use yii\widgets\DetailView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title="Личная информация";
?>
<!-- ========================= SECTION MAIN ========================= -->
<section class="section-main bg padding-top-sm">
    <div class="container">


        <div class="row">

            <aside class="col-sm-9">
                <div class="card">
                    <article class="card-body">
                        <h4 class="title mb-4">Изменить пароль - <span class="text-primary"><?=Html::encode($modelProfile->usernameid);?></span></h4>
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
                        <div class="col-md-8">
                            <?php $form=ActiveForm::begin();?>
                            <?php if($model->scenario==\app\models\Passwordchange::SCENARIO_PSWD_USER):?>
                                <?=$form->field($model, 'current_pswd')->passwordInput();?>

                            <?php endif;?>
                            <?=$form->field($model, 'new_pswd_con')->passwordInput();?>
                            <?=$form->field($model, 'new_pswd')->passwordInput()?>

                            <?=Html::submitButton(Yii::t('app', ' Изменит'), ['class'=>'btn btn-primary']);?>

                            <?php ActiveForm::end();?>
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



