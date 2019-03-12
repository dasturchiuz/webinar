<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\money\MaskMoney;
use yii\widgets\Pjax;
use kartik\select2\Select2;
?>
<div class="card card-filter">
    <article class="card-group-item">
        <header class="card-header">
            <a class="" aria-expanded="true" href="#" data-toggle="collapse" data-target="#collapse22">
                <i class="icon-action fa fa-chevron-down"></i>
                <h6 class="title"><?=Yii::t('app', 'Категории')?></h6>
            </a>
        </header>
        <div style="" class="filter-content collapse show" id="collapse22">
            <div class="card-body">
                <?php
                $data=\app\models\Category::buildTreeUserId($profile->user_id);
                ?>

                <ul class="nav-category">

                    <?php foreach($data as $item):?>
                        <li <?php if($category!=null && $category==$item['slug']):?> class="active" <?php endif;?>>
                            <?=Html::a($item['name'], ['shop/'.$profile->name_magazin, 'category'=>$item['slug'] ])?>
                        </li>

                    <?php endforeach;?>
                </ul>
            </div> <!-- card-body.// -->
        </div> <!-- collapse .// -->
    </article> <!-- card-group-item.// -->
    <?php if(!empty($listCategorySub)):?>
        <article class="card-group-item">
            <header class="card-header">
                <a class="" aria-expanded="true" href="#" data-toggle="collapse" data-target="#collapse22">
                    <i class="icon-action fa fa-chevron-down"></i>
                    <h6 class="title"><?=$category->name?></h6>
                </a>
            </header>
            <div style="" class="filter-content collapse show" id="collapse22">
                <div class="card-body">
                    <ul class="list-unstyled list-lg">

                        <?php foreach($listCategorySub as $itemsub): ?>
                            <li><a href="<?php echo $itemsub['slug'];?>"><?php echo $itemsub['name'];?> </a></li>
                        <?php endforeach;?>
                    </ul>
                </div> <!-- card-body.// -->
            </div> <!-- collapse .// -->
        </article> <!-- card-group-item.// -->
    <?php endif;?>
    <?php $form=\yii\widgets\ActiveForm::begin(['method'=>'get', 'action'=>'/shop/'.$profile->name_magazin]);?>




    <article class="card-group-item">
        <header class="card-header">
            <a href="#" data-toggle="collapse" data-target="#collapsePrice" aria-expanded="true" class="">
                <i class="icon-action fa fa-chevron-down"></i>
                <h6 class="title"><?=Yii::t('app', 'Ценовой диапазон')?>  </h6>
            </a>
        </header>
        <div class="filter-content collapse show" id="collapsePrice" style="">
            <div class="card-body">

                <div class="form-row">


                    <?=$form->field($searchModel, 'min_price', ['options'=>['class'=>'form-group col-md-6']])->textInput([
                        'options' => [
                            'placeholder' => 'Макс сумму...'
                        ],

                    ]); ?>
                    <?=$form->field($searchModel, 'max_price', ['options'=>['class'=>'form-group col-md-6']])->textInput([
                        'options' => [
                            'placeholder' => 'Макс сумму...'
                        ],

                    ]); ?>
                </div>
                <button class="btn btn-block btn-outline-primary btnhide text-white">Применять</button>

            </div>
        </div>
    </article>


    <article class="card-group-item">
        <header class="card-header">
            <a href="#" data-toggle="collapse" data-target="#collapseStar" aria-expanded="true" class="">
                <i class="icon-action fa fa-chevron-down"></i>
                <h6 class="title"><?=Yii::t('app', 'Звёздам')?>  </h6>
            </a>
        </header>
        <div class="filter-content collapse show" id="collapseStar" style="">
            <div class="card-body">
                <?= $form->field($searchModel, 'star_product', ['template' => '
                                            <label class="labelstar" style="display: flex !important;"> {input} &nbsp
                                            <ul class="list-rating" style="margin-top: 4px !important;">
                                                <li style="width:80%"class="stars-active">
                                                    <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </li>
                                                <li>
                                                    <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </li>
                                            </ul>  &nbsp или более</label> 
                                            
                                            
                                            
                                    '])->textInput(['class' => "","style"=>"margin-top: 7px !important;", "value"=>"4.0", 'checked'=>$searchModel->star_product>0 ? true : false, 'type' => 'checkbox']) ?>
                <button class="btn btn-block btn-outline-primary btnhide text-white">Применять</button>
            </div>
        </div>
    </article>

    <article class="card-group-item">
        <header class="card-header">
            <a href="#" data-toggle="collapse" data-target="#collapseStar" aria-expanded="true" class="">
                <i class="icon-action fa fa-chevron-down"></i>
                <h6 class="title"><?=Yii::t('app', 'Бренды')?>  </h6>
            </a>
        </header>
        <div class="filter-content collapse show" id="collapseStar" style="">
            <div class="card-body">
                <?=$form->field($searchModel, 'manufacturer_id')->widget(Select2::classname(), [
                    'data' => \yii\helpers\ArrayHelper::map(\app\models\Manufacturer::find()->all(), 'id', 'name'),
                    'size' => Select2::LARGE,
                    'options' => ['placeholder' => 'Выберите бренды ..', 'multiple' => true
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]); ?>
                <button class="btn btn-block btn-outline-primary btnhide text-white">Применять</button>

            </div>
        </div>
    </article>

    <?php \yii\widgets\ActiveForm::end();?>

</div>