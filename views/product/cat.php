<?php
use yii\helpers\Url;
use kartik\money\MaskMoney;
use yii\widgets\Pjax;
use kartik\select2\Select2;
$this->title=$category->name;
$data_categor=array_reverse(app\models\Category::getCat($category->parent_id));
foreach($data_categor as $item){
    $this->params['breadcrumbs'][] = ['label' => $item['name'], 'url' => ['/product/category/'. $item['slug']]];
}

$this->params['breadcrumbs'][] = $this->title;
?>
<?php Pjax::begin(['enablePushState' => true]); ?>
<!-- ========================= SECTION MAIN ========================= -->
<section class="section-main  padding-top-sm">
    <div class="container">
        <?php if(Yii::$app->session->hasFlash('error')):?>
            <div class="alert alert-danger" role="alert">
                <?php echo Yii::$app->session->getFlash('error'); ?>
            </div>


        <?php endif;?>
        <?=
        yii\widgets\Breadcrumbs::widget([
            'itemTemplate'=>'<li class="breadcrumb-item">{link}</li>',
            'activeItemTemplate'=>"<li class=\"breadcrumb-item active\">{link}</li>\n",
            'homeLink' => [
                'label' => Yii::t('yii', 'Главная'),
                'url' => Yii::$app->homeUrl,
            ],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ])
        ?>
        <div class="row row-sm mb-3">
            <aside class="col-sm-3">
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
                                <ul class="list-unstyled list-lg">

                                    <?php foreach($listCategory as $item): ?>
                                    <li><a href="<?php echo $item['slug'];?>"><?php echo $item['name'];?> </a></li>
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
                    <?php $form=\yii\widgets\ActiveForm::begin(['method'=>'get', 'action' => ['/product/category/'.$category->slug],]);?>
                    <article class="card-group-item">
                        <header class="card-header">
                            <a href="#" data-toggle="collapse" data-target="#collapseSeller" aria-expanded="true" class="">
                                <i class="icon-action fa fa-chevron-down"></i>
                                <h6 class="title"><?=Yii::t('app', 'Регионам')?>  </h6>
                            </a>
                        </header>
                        <div class="filter-content collapse show" id="collapseSeller" style="">
                            <div class="card-body">
                                <?=$form->field($searchModel, 'region_id')->widget(Select2::classname(), ['data' => \yii\helpers\ArrayHelper::map(\app\models\Regions::find()->all(), 'id', 'name_obl'),
                                    'size' => Select2::LARGE,
                                    'options' => ['placeholder' => 'Выберите область ..', 'multiple' => true],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]); ?>
                                <button class="btn btn-block btn-outline-primary btnhide text-white">Применять</button>


                            </div>
                        </div>
                    </article>



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
                    <?php if(!empty($brand)):?>
                    <article class="card-group-item">
                        <header class="card-header">
                            <a href="#" data-toggle="collapse" data-target="#collapse44" aria-expanded="true" class="">
                                <i class="icon-action fa fa-chevron-down"></i>
                                <h6 class="title"><?=Yii::t('app', 'Бренды')?> </h6>
                            </a>
                        </header>
                        <div style="" class="filter-content collapse show" id="collapse22">
                            <div class="card-body">
                                <ul class="list-unstyled list-lg">

                                    <?php foreach($brand as $brandItem):?>
                                        <li><a href="?brand=<?=$brandItem->brand['id']?>"> <?=$brandItem->brand['name']?> </a></li>
                                    <?php endforeach;?>
                                </ul>
                            </div> <!-- card-body.// -->
                        </div>


                    </article> <!-- card-group-item.// -->
                    <?php endif;?>
                    <?php \yii\widgets\ActiveForm::end();?>

                </div>
            </aside> <!-- col.// -->

            <div class="col-sm-9">

                <nav class="navbar navbar-expand-lg navHead navbar-light mb-2">
                    <a class="navbar-brand" href="#"><?=$category->name?></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ml-auto mt-lg-0">
                            <li class="nav-item dropdown  navbar-left">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?=Yii::t('app', 'Сортировать по')?></a>
                                <div class="dropdown-menu dropdown-menu-right ">
<!--                                    <a class="dropdown-item" href="#">--><?php //=Yii::t('app', 'Цена')?><!--</a>-->
                                    <a class="dropdown-item" href="?sort=name"><?=Yii::t('app', 'Название')?></a>
                                    <a class="dropdown-item" href="?sort=views"><?=Yii::t('app', 'Популярности')?></a>

                                </div>
                            </li>
                        </ul>

                    </div>
                </nav>



                <div class="row row-sm">

                    <?=yii\widgets\ListView::widget([
                        'dataProvider'=>$dataProvider,


                        'layout' => "\n
                            <div class='row'>
                                {items}
                            </div>\n <nav aria-label=\"Page navigation example\">{pager} </nav>",
                        'pager'=>[
                            'options'=>['class'=>'pagination justify-content-center'],
                            'linkContainerOptions'=>['class'=>'page-item'],
                            'linkOptions'=>['class'=>'page-link'],
                            'disabledPageCssClass'=>['class'=>'page-link'],
                        ],
                        'summary'=>"<div>".Yii::t('app', "Тавары")." {begin} - {end} ".Yii::t('app', "из")." {totalCount} </div>",
                        'itemView' => function ($model, $key, $index, $widget) {
                            return $this->render('_item',['model' => $model, 'index'=>$index]);

                            // or just do some echo
                            // return $model->title . ' posted by ' . $model->author;
                        },
                        'emptyText'=>"<h3>Результатов не найдено.</h3>",
                        'itemOptions' => [
                            'tag' => false,
                        ],
                        'options' => [
                            'tag' => 'div',
                            'class' => 'container',
                            'id' => 'cont',
                        ],
                    ]);?>


                </div>
            </div>


        </div>

        <hr>

    </div>

</section>


<?php Pjax::end(); ?>