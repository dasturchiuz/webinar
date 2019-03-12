<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Категории');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Добавить категорию'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          //  'id',
            [
                'attribute'=>'parent_id',
                'format'=>'raw',
                'value'=>function($data){
                   return  !empty($data->parentt) ? $data->parentt->name : 'Нет радителский категория';

                }
            ],
            'name',
            'code',
            'slug',
            //'text:ntext',
            //'image:ntext',
            //'sort',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
