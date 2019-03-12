<?php
use yii\widgets\DetailView;
use yii\helpers\Html;
use yii\helpers\Url;
$this->title="Cвязаться с нами";
?>
<!-- ========================= SECTION MAIN ========================= -->
<section class="section-main bg padding-top-sm">
    <div class="container">
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

        <div class="row">

            <aside class="col-sm-12">
                <div class="card">
                    <article class="card-body">
                        <h4 class="title mb-4"><?=Html::encode($this->title);?></h4>
                        <hr>
                        <div class="row mt-3">

                            <aside class="col-sm-6">
                                <article class="card-body">
                                    <?php $form=\yii\widgets\ActiveForm::begin();?>
                                        <?=$form->field($model, 'client_name')->textInput()?>
                                        <?=$form->field($model, 'theme_appeal')->textInput()?>
                                        <?=$form->field($model, 'telefon')->textInput()?>
                                        <?=$form->field($model, 'email')->textInput()?>
                                        <?=$form->field($model, 'text_appeal')->textArea()?>
                                       
                                        <?=Html::submitButton('Отправить', ['class'=>'btn btn-primary float-right'])?>
                                    <?php \yii\widgets\ActiveForm::end();?>
                                </article> <!-- card-body.// -->
                            </aside> <!-- col.// -->
                            <aside class="col-sm-6">
                                <article class="card-body">
                                    <p ><strong>По вопросам сотрудничества на торговой площадке и размещения товаров обращаться по адресу</strong> </p>

                                    <p><strong>Наш адрес:</strong>&nbsp;г. Самарканд, ул. Мир Саид Барака 32 (Некрасова). </p>

                                        <p><strong>Контактный телефон:</strong> +998 (90) 603 90 80 </p>

                                        <p ><strong>Почтовый индекс:</strong> 140108</p>


                                </article> <!-- card-body.// -->
                            </aside> <!-- col.// -->

                        </div>

                    </article> <!-- card-body.// -->
                </div>

            </aside> <!-- col.// -->


        </div>

    </div>
</section>



