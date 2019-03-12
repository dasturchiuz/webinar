<?php
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use pendalf89\filemanager\widgets\TinyMCE;
use pendalf89\filemanager\widgets\FileInput;
use wbraganca\dynamicform\DynamicFormWidget;
use app\models\Unit;
use kartik\money\MaskMoney;
/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin([
    'class' => 'form-horizontal',
    'id' => 'dynamic-form',
    'options' => [
        'enctype' => 'multipart/form-data'
    ]
]); ?>
<?php
$dataTyppp=[];
foreach($autocomplement as $item){
    $dataTyppp[]=$item['attr_name'];
}
$dataTypppValue=[];

foreach($autocomplementValue as $item){
    $dataTypppValue[]=addslashes($item['attr_value']);
}
$this->registerJS('
        $( function() {
    var availableTags = [
        "'.implode('","', $dataTyppp).'"
    ];
    var availableValues = [
        "'.implode('","', $dataTypppValue).'"
    ];
    $( ".attrvalue").autocomplete({
      source: availableValues
    });

    $( ".attrname").autocomplete({
      source: availableTags
    });
  } );
        ');

?>

<div class="product-form">
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#home">Генеральная</a></li>
        <li><a data-toggle="tab" href="#data">Цена </a></li>
        <li><a data-toggle="tab" href="#data_sales">Данные</a></li>
        <li><a data-toggle="tab" href="#links">Связи</a></li>
<!--        <li><a data-toggle="tab" href="#skidka">Скидка</a></li>-->
        <li><a data-toggle="tab" href="#attr">Атрибуты</a></li>
        <li><a data-toggle="tab" href="#images">Фотография</a></li>
        <li>
                <?= Html::submitButton(Yii::t('app', '<i class="fa fa-save"></i> Сохранять'), ['class' => 'btn btn-success pull-right']) ?>

            </li>
    </ul>

    <div class="tab-content">
        <div id="home" class="tab-pane fade in active">
            <h3>Генеральная</h3>
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'short_text')->widget(TinyMCE::className(), [
                'clientOptions' => [
                    'language' => 'ru',
                    'menubar' => false,
                    'height' => 200,
                    'image_dimensions' => false,
                    'plugins' => [
                        'advlist autolink lists link image charmap print preview anchor searchreplace visualblocks code contextmenu table',
                    ],
                    'toolbar' => 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code',
                ],
            ]); ?>



            <?= $form->field($model, 'text')->widget(TinyMCE::className(), [
                'clientOptions' => [
                    'language' => 'ru',
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
                    'language' => 'ru',
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

        <div id="data" class="tab-pane fade">
            <h3>Цена</h3>

            <?php //= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
            <div class="row">
                <div class="col-md-3">
                    <?= $form->field($model, 'price')->widget(MaskMoney::classname(), [
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
                    <?= $form->field($model, 'unit_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Unit::find()->where(['status'=>Unit::STATUS_ON])->asArray()->all(), 'id', 'unit_name'), ['prompt' => 'Выберите..']) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'available')->dropDownList([ 'yes' => 'Yes', 'no' => 'No', ], ['prompt' => '']) ?>
                </div>


            </div>










            <?php //= $form->field($model, 'is_popular')->dropDownList([ 'yes' => 'Yes', 'no' => 'No', ], ['prompt' => '']) ?>




            <?php //= $form->field($model, 'sort')->textInput() ?>

        </div>
        <div id="data_sales" class="tab-pane fade">
            <h3>Данные</h3>
            <?php
                $select_array=['role'=>'client_juridical'];
                if(!\app\models\User::isSuperAdmin()){
                    $select_array=['region_id'=>Yii::$app->user->identity->getRegionId(), 'role'=>'client_juridical'];
                }

            ?>
            <?= $form->field($model, 'user_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Profile::find()->where($select_array)->all(), 'user_id', function($profile, $defaultValue){
                return $profile->usernameid." - ".$profile->juridical->orgon->name." ".$profile->juridical->tashkilot." - ".$profile->fullnameemp;
            }), ['prompt'=>'Выберите..']) ?>

        </div>
        <div id="links" class="tab-pane fade">
            <h3>Связи</h3>
            <?php $encoded = \yii\helpers\ArrayHelper::htmlEncode(\app\models\Category::getCategories());?>


            <?= $form->field($model, 'region_id')->dropDownList(\yii\helpers\ArrayHelper::map(app\models\Regions::find()->asArray()->all(), 'id', 'name_obl'), ['prompt'=>'Выберите..']) ?>
            <?= $form->field($model, 'category_id')->dropDownList(\yii\helpers\ArrayHelper::map($encoded, 'id', 'name'), ['prompt'=>'Выберите..']) ?>
            <?= $form->field($model, 'manufacturer_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Manufacturer::find()->asArray()->all(), 'id', 'name'), ['prompt'=>'Выберите..']) ?>

            <?php //= $form->field($model, 'related_products')->textarea(['rows' => 6]) ?>
        </div>

<!--        <div id="skidka" class="tab-pane fade">-->
<!--            <h3>Скидака</h3>-->
<?php //DynamicFormWidget::begin([
//                'widgetContainer' => 'dynamicform_wrapper_skidka', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
//                'widgetBody' => '.container-skidka', // required: css class selector
//                'widgetItem' => '.skidka', // required: css class
//
//                'min' => 1, // 0 or 1 (default 1)
//                'insertButton' => '.add-skidka', // css class
//                'deleteButton' => '.remove-skidka', // css class
//                'model' => $modelDiscount[0],
//                'formId' => 'dynamic-form',
//                'formFields' => [
//                    'price_procent',
//                    'discount_name',
//                    'date_start',
//                    'date_end',
//                ],
//            ]); ?>

<!--                    <div class=" panel panel-default">-->
<!--                        <div class="panel-heading">-->
<!--                            <h3 class="panel-title pull-left">Скидака</h3>-->
<!--                            <div class="pull-right">-->
<!--                                <button type="button" class="add-skidka btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>-->
<!---->
<!--                            </div>-->
<!--                            <div class="clearfix"></div>-->
<!--                        </div>-->
<!--                        <div class="panel-body">-->
<!--                            <div class="container-skidka">-->
<!--                            --><?php //foreach ($modelDiscount as $skid_key => $skid_model): ?>
<!--                            <div class="skidka">-->
<!---->
<!--                                <div class="row">-->
<!--                                    --><?php
//                                        if(!$skid_model->isNewRecord)
//                                        {
//                                            echo Html::activeHiddenInput($skid_model, "[$skid_key]id");
//                                        }
//                                    ?>
<!--                                    <div class="col-md-1">-->
<!--                                        <button type="button" class="remove-skidka btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>-->
<!--                                    </div>-->
<!---->
<!--                                    <div class="col-md-2">-->
<!--                                        --><?php //echo $form->field($skid_model, '['.$skid_key.']discount_name' )->textInput(['class'=>'form-control']);?>
<!--                                    </div>-->
<!--                                    <div class="col-md-1">-->
<!--                                        --><?php //echo $form->field($skid_model, '['.$skid_key.']price_procent' )->textInput(['class'=>'form-control']);?>
<!--                                    </div>-->
<!--                                    <div class="col-md-3">-->
<!--                                        --><?php ////=$form->field($skid_model, '['.$skid_key.']date_strat' )->widget(DatePicker::classname(), [
////                                            'options' => ['placeholder' => 'Enter birth date ...'],
////                                            'pluginOptions' => [
////                                                'autoclose'=>true
////                                            ]
////                                        ]);?>
<!--                                        --><?php //echo $form->field($skid_model, '['.$skid_key.']date_start' )->widget(\yii\jui\DatePicker::classname(), [
//                                            //'language' => 'ru',
//                                            'dateFormat' => "d-M-yyyy",
//                                            'options' => ['class' => 'form-control picker']
//                                        ]) ?>
<!---->
<!--                                    </div>-->
<!--                                    <div class="col-md-3">-->
<!--                                        --><?php //echo $form->field($skid_model, '['.$skid_key.']date_end' )->widget(\yii\jui\DatePicker::classname(), [
//                                            //'language' => 'ru',
//                                            'dateFormat' => "d-M-yyyy",
//                                            'options' => ['class' => 'form-control picker']
//                                        ]) ?>
<!--                                    </div>-->
<!--                                    <div class="col-md-2">-->
<!--                                        --><?php //echo $form->field($skid_model, '['.$skid_key.']status' )->dropDownList(\app\models\Discount::getStatuses(), ['prmpt'=>'Выберите']) ?>
<!--                                    </div>-->
<!---->
<!---->
<!--                                </div>-->
<!---->
<!--                            </div>-->
<!---->
<!--                            --><?php // endforeach; ?>
<!--                            </div>-->
<!--                            <div class="pull-right">-->
<!--                                <button type="button" class="add-skidka btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>-->
<!---->
<!--                            </div>-->
<!--                            <div class="clearfix"></div>-->
<!---->
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!---->
<!--            --><?php //DynamicFormWidget::end(); ?>
<!---->
<!--        </div>-->

        <div id="attr" class="tab-pane fade">
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


                    <div class=" panel panel-default"><!-- widgetBody -->
                        <div class="panel-heading">
                            <h3 class="panel-title pull-left">Атрибуты товара (продукта)</h3>
                            <div class="pull-right">
                                <button type="button" class="add-item1 btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>

                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <div class="container-items1">
                            <?php foreach ($modelAttr as $i1 => $models1): ?>
                            <div class="item1">

                                <div class="row">
                                    <?php
                                        if(!$models1->isNewRecord)
                                        {
                                            echo Html::activeHiddenInput($models1, "[$i1]id");
                                        }
                                    ?>
                                    <div class="col-md-1">
                                        <button type="button" class="remove-item1 btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                                    </div>
                                    <div class="col-md-1">
                                        <?=$form->field($models1, '['.$i1.']is_group' )->checkbox();?>
                                    </div>
<!--                                    <div class="col-md-1">-->
<!--                                        --><?php ////=$form->field($models1, '['.$i1.']is_filter' )->checkbox();?>
<!--                                    </div>-->
                                    <div class="col-md-1">
                                        <?=$form->field($models1, '['.$i1.']is_main' )->checkbox();?>
                                    </div>

                                    <div class="col-md-4">
                                        <?=$form->field($models1, '['.$i1.']attr_name' )->textInput(['class'=>'form-control attrname']);?>

                                    </div>
                                    <div class="col-md-4">
                                        <?=$form->field($models1, '['.$i1.']attr_value' )->textInput(['class'=>'form-control attrvalue']);?>

                                    </div>

                                </div>

                            </div>

                            <?php  endforeach; ?>
                            </div>
                            <div class="pull-right">
                                <button type="button" class="add-item1 btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>

                            </div>
                            <div class="clearfix"></div>

                        </div>
                    </div>


            <?php DynamicFormWidget::end(); ?>

        </div>

        <?php
        $this->registerJs('
$(function () {
    $(".dynamicform_wrapper_skidka").on("afterInsert", function(e, item) {
        $( ".dob" ).each(function() {
           $( this ).datepicker({
              dateFormat : "dd/mm/yy",
              yearRange : "1925:+0",
              maxDate : "-1D",
              changeMonth: true,
              changeYear: true
           });
      });
    });
});
$(function () {
    $(".dynamicform_wrapper_skidka").on("afterDelete", function(e, item) {
        $( ".dob" ).each(function() {
           $( this ).removeClass("hasDatepicker").datepicker({
              dateFormat : "dd/mm/yy",
              yearRange : "1925:+0",
              maxDate : "-1D",
              changeMonth: true,
              changeYear: true
           });
      });
    });
});
');
        $js = '
$(".dynamicform_wrapper").on("beforeInsert", function(e, item) {
    console.log("beforeInsert");
});

$(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    console.log("afterInsert");
});

$(".dynamicform_wrapper").on("beforeDelete", function(e, item) {
    if (! confirm("Are you sure you want to delete this item?")) {
        return false;
    }
    return true;
});

$(".dynamicform_wrapper").on("afterDelete", function(e) {
    console.log("Deleted item!");
});

$(".dynamicform_wrapper").on("limitReached", function(e, item) {
    alert("Limit reached");
});
';

        $jsss='
        $( function() {
            $(".date" ).datepicker();
        });';


//       $this->registerJs($jsss);
        $this->registerJs(<<<JS
    $(function () {
    $(".dynamicform_wrapper_skidka").on("afterInsert", function(e, item) {
         $( ".picker" ).each(function() {
            $( this ).datepicker({
            dateFormat : 'dd-mm-yy',
            language : 'en',
            changeMonth: true,
            changeYear: true
          });
        });
    });
});
JS
            , \yii\web\View::POS_END);

        ?>
        <div id="images" class="tab-pane fade">
            <h3>Фотография</h3>

            <?= $form->field($model, 'product_images[]')->fileInput(['multiple' => true, 'accept' => 'image/*'])?>
            <div class="row">
                <?php foreach($model->getImages() as $gallery_image):?>

                    <div class="col-xs-6 col-md-3">
                        <div  class="thumbnail products_image_form  <?php if($gallery_image->isMain==1):?> mainimg <?php endif;?>">
                            <a class="btn delete_products_img" title="Удалить?" href="<?=Url::toRoute(['/administration/product/deleteimg', 'id_product'=>$model->id, 'id_img'=>$gallery_image->id])?>" data-id="'.$img_g->id.'"><span class="glyphicon glyphicon-remove"></span></a>
                            <a class="fancybox img-rounded setMain" rel="gallery1" href="<?=Url::toRoute(['/administration/product/setmain', 'id_product'=>$model->id, 'id_img'=>$gallery_image->id])?>"><?=Html::img('/'.$gallery_image->getPath('200x200'), ['alt' => ''])?></a>
                        </div>
                    </div>

                <?php endforeach;?>
            </div>
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
        </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>