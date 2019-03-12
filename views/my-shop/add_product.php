<?php
//use yii\widgets\DetailView;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\number\NumberControl;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;
use wbraganca\dynamicform\DynamicFormWidget;
use app\models\Unit;
use kartik\money\MaskMoney;

$this->title = $model->isNewRecord ? Yii::t('app', 'Добавить новый товар') : Yii::t('app', 'Редактирование товара');

?>
    <!-- ========================= SECTION MAIN ========================= -->
    <section class="section-main bg padding-top-sm">
        <div class="container">


            <div class="row">

                <aside class="col-md-9">
                    <div class="card">
                        <article class="card-body">
                            <?php $form = ActiveForm::begin([
                                'class' => 'form-horizontal',
                                'id' => 'dynamic-form',
                                'options' => [
                                    'enctype' => 'multipart/form-data'
                                ]
                            ]); ?>

                            <h4 class="title mb-4"><?= $this->title ?></h4>
                            <hr>
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                                       role="tab" aria-controls="pills-home"
                                       aria-selected="true"><?= Yii::t('app', 'Генеральная') ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-price-tab" data-toggle="pill" href="#pills-price"
                                       role="tab" aria-controls="pills-price"
                                       aria-selected="false"><?= Yii::t('app', 'Цена') ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-connections-tab" data-toggle="pill"
                                       href="#pills-connections" role="tab" aria-controls="pills-connections"
                                       aria-selected="false"><?= Yii::t('app', 'Связи') ?></a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="pills-attribute-tab" data-toggle="pill"
                                       href="#pills-attribute" role="tab" aria-controls="pills-attribute"
                                       aria-selected="false"><?= Yii::t('app', 'Атрибути') ?></a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="pills-photos-tab" data-toggle="pill" href="#pills-photos"
                                       role="tab" aria-controls="pills-photos"
                                       aria-selected="false"><?= Yii::t('app', 'Фотография') ?></a>
                                </li>
                                <li class="nav-item">
                                    <?= Html::submitButton('<i class="fa fa-save"></i> ' . Yii::t('app', 'Опубликовать товар'), ['class' => 'btn btn-success  ml-auto']) ?>

                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                     aria-labelledby="pills-home-tab">
                                    <h3>Генеральная</h3>
                                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                                    <?= $form->field($model, 'short_text')->widget(TinyMCE::className(), [
                                        'clientOptions' => [
                                            'menubar' => false,
                                            'height' => 200,
                                            //'image_dimensions' => false,

                                            //'toolbar' => 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code',
                                        ],
                                    ]); ?>

                                    <?= $form->field($model, 'text')->widget(TinyMCE::className(), [
                                        'clientOptions' => [

                                            'menubar' => false,
                                            'height' => 300,
                                            'image_dimensions' => false,
                                            'plugins' => [
                                                'advlist autolink lists link image charmap print preview anchor searchreplace visualblocks code contextmenu table',
                                            ],
                                            'toolbar' => 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code',
                                        ],
                                    ]); ?>
                                    <?= $form->field($model, 'return_guarantee')->widget(TinyMCE::className(), [
                                        'clientOptions' => [

                                            'menubar' => false,
                                            'height' => 200,
                                            'image_dimensions' => false,
                                            'plugins' => [
                                                'advlist autolink lists link image charmap print preview anchor searchreplace visualblocks code contextmenu table',
                                            ],
                                            'toolbar' => 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code',
                                        ],
                                    ]); ?>


                                </div>
                                <div class="tab-pane fade" id="pills-price" role="tabpanel"
                                     aria-labelledby="pills-price-tab">
                                    <h3>Цена</h3>

                                    <?php //= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <?php
                                            //                                        $form->field($model, 'price')->widget(NumberControl::classname(), [
                                            //
                                            //
                                            //                                            //'options' => $saveOptions,
                                            //                                            'displayOptions' => ['class' => 'form-control kv-monospace'] + [
                                            //                                                    'placeholder' => 'Enter a valid amount...'
                                            //                                                ],
                                            //                                            //'saveInputContainer' => $saveCont
                                            //                                        ]); ?>

                                            <?php
                                            echo $form->field($model, 'price')->widget(MaskMoney::classname(), [
                                                'options' => [
                                                    'placeholder' => 'Enter a valid amount...'
                                                ],
                                                'pluginOptions' => [
                                                    'prefix' => '$ ',
                                                    'suffix' => ' сум',
                                                    'precision' =>null,
                                                    'allowNegative' => true,
                                                    'allowZero' => true,

                                                ]
                                            ]);
                                            ?>
                                        </div>
                                        <div class="col-md-3">
                                            <?= $form->field($model, 'old_price')->widget(MaskMoney::classname(), [
                                                'options' => [
                                                    'placeholder' => 'Введите сумму...'
                                                ],
                                                'pluginOptions' => [
                                                    'prefix' => '$ ',
                                                    'suffix' => ' сум',
                                                    'precision' =>null,
                                                    'allowNegative' => true,
                                                    'allowZero' => true,

                                                ]
                                            ]); ?>
                                        </div>
                                        <div class="col-md-3">
                                            <?= $form->field($model, 'price_protsent')->textInput() ?>

                                        </div>
                                        <div class="col-md-3">
                                            <?= $form->field($model, 'type_product')->dropDownList(app\models\Product::getProductTypeStatus(), ['prompt' => 'Выберите тип товара']) ?>


                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <?= $form->field($model, 'wholesale_price')->widget(MaskMoney::classname(), [
                                                'options' => [
                                                    'placeholder' => 'Введите сумму...'
                                                ],
                                                'pluginOptions' => [
                                                    'prefix' => '$ ',
                                                    'suffix' => ' сум',
                                                    'precision' =>null,
                                                    'allowNegative' => true,
                                                    'allowZero' => true,

                                                ]
                                            ]); ?>

                                        </div>
                                        <div class="col-md-3">
                                            <?= $form->field($model, 'wholesale_count')->textInput() ?>

                                        </div>
                                        <div class="col-md-3">
                                            <?= $form->field($model, 'wholesale_protsent')->textInput() ?>

                                        </div>
                                        <div class="col-md-3">

                                            <?= $form->field($model, 'type_ads')->dropDownList(app\models\Product::getProductTypeADStatus(), ['prompt' => 'Выберите тип']) ?>
                                            <?= $form->field($model, 'price_ads')->widget(MaskMoney::classname(), [
                                                'options' => [
                                                    'placeholder' => 'Введите сумму...'
                                                ],
                                                'pluginOptions' => [
                                                    'prefix' => '$ ',
                                                    'suffix' => ' сум',
                                                    'precision' =>null,
                                                    'allowNegative' => true,
                                                    'allowZero' => true,

                                                ]
                                            ]); ?>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <?= $form->field($model, 'amount')->textInput() ?>
                                        </div>
                                        <div class="col-md-3">
                                            <!--https://pages.ebay.com/ru/ru-ru/help/sell/item-condition.html-->
                                            <?= $form->field($model, 'product_status')->dropDownList([
                                                'Новый' => 'Новый',
                                                'Новый с ярлыками' => 'Новый с ярлыками',
                                                'Новый без ярлыков' => 'Новый без ярлыков',
                                                'Новый с дефектами' => 'Новый с дефектами',
                                                'Новый без коробки' => 'Новый без коробки',
                                                'Совершенно новый' => 'Совершенно новый',
                                                'Фабрично модернизированный' => 'Фабрично модернизированный',
                                                'Как новый' => 'Как новый',
                                                'Поврежденный' => 'Поврежденный',
                                                'Очень хорошее состояние' => 'Очень хорошее состояние',
                                                'Хороший' => 'Хороший',
                                                'Удовлетворительное состояние' => 'Удовлетворительное состояние',
                                                'Новый: прочее ' => 'Новый: прочее ',
                                                'Бывший в употреблении' => 'Бывший в употреблении',
                                                'Восстановлен производителем' => 'Восстановлен производителем',
                                                'Восстановлен продавцом' => 'Восстановлен продавцом',
                                                'Б/у' => 'Б/у',
                                                'Сертифицированный б/у' => 'Сертифицированный б/у',
                                                'Для разборки на запчасти или в нерабочем состоянии' => 'Для разборки на запчасти или в нерабочем состоянии',
                                                'no' => 'No',
                                            ], ['prompt' => 'Выберите состояние']) ?>
                                        </div>
                                        <div class="col-md-3">
                                            <?= $form->field($model, 'unit_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Unit::find()->where(['status' => Unit::STATUS_ON])->asArray()->all(), 'id', 'unit_name'), ['prompt' => 'Выберите..']) ?>
                                        </div>
                                        <div class="col-md-3">
                                            <?= $form->field($model, 'available')->dropDownList(['yes' => 'Разморозить ', 'no' => 'Заморозить',], ['prompt' => '']) ?>
                                        </div>


                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-connections" role="tabpanel"
                                     aria-labelledby="pills-connections-tab">
                                    <h3>Связи</h3>

                                    <?php $encoded = \yii\helpers\ArrayHelper::htmlEncode(\app\models\Category::getCategories()); ?>


                                    <?= $form->field($model, 'region_id')->dropDownList(\yii\helpers\ArrayHelper::map(app\models\Regions::find()->asArray()->all(), 'id', 'name_obl'), ['prompt' => 'Выберите..']) ?>
                                    <?= $form->field($model, 'category_id')->dropDownList(\yii\helpers\ArrayHelper::map($encoded, 'id', 'name'), ['prompt' => 'Выберите..']) ?>
                                    <?= $form->field($model, 'manufacturer_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Manufacturer::find()->asArray()->all(), 'id', 'name'), ['prompt' => 'Выберите..']) ?>

                                </div>
                                <div class="tab-pane fade" id="pills-attribute" role="tabpanel"
                                     aria-labelledby="pills-attribute-tab">
                                    <h3>Атрибути</h3>

                                    <?php DynamicFormWidget::begin([
                                        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                                        'widgetBody' => '.container-items1', // required: css class selector
                                        'widgetItem' => '.item1', // required: css class

                                        'min' => 1, // 0 or 1 (default 1)
                                        'insertButton' => '.add-item1', // css class
                                        'deleteButton' => '.remove-item1', // css class
                                        'model' => $modelAttr[0],
                                        'formId' => 'dynamic-form',
                                        'formFields' => [
                                            'attr_name',
                                            'attr_value',
                                            'is_group',
                                            'is_filter',
                                        ],
                                    ]); ?>


                                    <div class="card"><!-- widgetBody -->

                                        <div class="card-body">
                                            <h5 class="card-title">Атрибуты товара (продукта)</h5>
                                            <div class="container-items1">
                                                <?php foreach ($modelAttr as $i1 => $models1): ?>
                                                    <div class="item1">

                                                        <div class="row">
                                                            <?php
                                                            if (!$models1->isNewRecord) {
                                                                echo Html::activeHiddenInput($models1, "[$i1]id");
                                                            }
                                                            ?>
                                                            <div class="col-md-1">
                                                                <button type="button"
                                                                        class="remove-item1 btn btn-danger btn-xs"><i
                                                                            class="fa fa-minus" aria-hidden="true"></i>
                                                                </button>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <?= $form->field($models1, '[' . $i1 . ']is_group')->checkbox(); ?>
                                                            </div>
                                                            <!--                                    <div class="col-md-1">-->
                                                            <!--                                        --><?php ////=$form->field($models1, '['.$i1.']is_filter' )->checkbox();?>
                                                            <!--                                    </div>-->
                                                            <div class="col-md-1">
                                                                <?= $form->field($models1, '[' . $i1 . ']is_main')->checkbox(); ?>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <?= $form->field($models1, '[' . $i1 . ']attr_name')->textInput(['class' => 'form-control attrname']); ?>

                                                            </div>
                                                            <div class="col-md-4">
                                                                <?= $form->field($models1, '[' . $i1 . ']attr_value')->textInput(['class' => 'form-control attrvalue']); ?>

                                                            </div>

                                                        </div>

                                                    </div>

                                                <?php endforeach; ?>
                                            </div>
                                            <div class="pull-right">
                                                <button type="button" class="add-item1 btn btn-success btn-xs"><i
                                                            class="fa fa-plus" aria-hidden="true"></i></button>

                                            </div>
                                            <div class="clearfix"></div>

                                        </div>
                                    </div>


                                    <?php DynamicFormWidget::end(); ?>
                                </div>
                                <div class="tab-pane fade" id="pills-photos" role="tabpanel"
                                     aria-labelledby="pills-photos-tab">
                                    <h3>Фотография</h3>
                                    <?= $form->field($model, 'product_images[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
                                    <div class="row">
                                        <?php foreach ($model->getImages() as $gallery_image): ?>

                                            <div class="col-xs-6 col-md-3">
                                                <div class="thumbnail products_image_form  <?php if ($gallery_image->isMain == 1): ?> mainimg <?php endif; ?>">
                                                    <a class="btn delete_products_img" title="Удалить?"
                                                       href="<?= Url::toRoute(['/my-shop/deleteimg', 'id_product' => $model->id, 'id_img' => $gallery_image->id]) ?>"
                                                       data-id="'.$img_g->id.'"><span
                                                                class="glyphicon glyphicon-remove"></span></a>
                                                    <a class="fancybox img-rounded setMain" rel="gallery1"
                                                       href="<?= Url::toRoute(['/my-shop/setmainimage', 'id_product' => $model->id, 'id_img' => $gallery_image->id]) ?>"><?= Html::img('/' . $gallery_image->getPath('200x200'), ['alt' => '']) ?></a>
                                                </div>
                                            </div>

                                        <?php endforeach; ?>
                                    </div>
                                </div>

                            </div>

                            <?php ActiveForm::end(); ?>


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


<?php
$this->registerJS("
                    $(document).on(\"click\", \".delete_products_img\", function(event){
                        event.preventDefault();
                        var is_true=confirm('Удалить изображение?');
                        if(is_true){
                            var href =$(this).attr('href');
                            $(this).parent('div').parent('div').remove();
                            $.get(href);
                        }
                    });
                    $(document).on(\"click\", \".setMain\", function(event){
                        event.preventDefault();
                        var is_true=confirm('Главное изображение?');
                        if(is_true){
                            var href =$(this).attr('href');
                            var mm=$(this);
                            $.get(href, function(data){
                                if(data=='true'){
                                    $('.mainimg').removeClass('mainimg');
                                    mm.parent().addClass('mainimg');
                                    alert('Была главное изображение');
                                }
                            });
                        }
                    });

                ");
?>


<?php
$dataTyppp = [];
foreach ($autocomplement as $item) {
    $dataTyppp[] = $item['attr_name'];
}
$dataTypppValue = [];

foreach ($autocomplementValue as $item) {
    $dataTypppValue[] = addslashes($item['attr_value']);
}
$this->registerJS('
        $( function() {
    var availableTags = [
        "' . implode('","', $dataTyppp) . '"
    ];
    var availableValues = [
        "' . implode('","', $dataTypppValue) . '"
    ];
    $( ".attrvalue").autocomplete({
      source: availableValues
    });

    $( ".attrname").autocomplete({
      source: availableTags
    });
  } );
        ');

\app\assets\ProductAsset::register($this);
?>