<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\administration\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cтраницы');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            <span class="label label-primary pull-right"><i class="fa fa-html5"></i></span>
        </div><!-- /.box-header -->
        <div class="box-body">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Cоздание страницы'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'slug',
            'title:ntext',
            //'meta_keywords:ntext',
            //'meta_description:ntext',
            //'content:ntext',
            [
                'attribute'=>'status',
                'format'=>'html',
                'value'=>function($data){
                    if($data->status==0)
                        return "Не опубликован";
                    elseif($data->status==null){
                        return "Статус нет";
                    }else{
                        return "Опубликован";
                    }
                }

            ],
            'created_at:datetime',
            //'updated_at',
            //'created_by',

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>"{update}{delete}"

            ],
        ],
    ]); ?>
        </div><!-- /.box -->
    </div>
</div>
