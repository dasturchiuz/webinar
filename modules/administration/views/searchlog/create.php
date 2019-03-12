<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SearchLog */

$this->title = Yii::t('app', 'Создать Search Log');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Search Logs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="search-log-create">

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
            </div>
        </div>

</div>
