<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Productreviews */

$this->title = Yii::t('app', 'Create Productreviews');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Productreviews'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="productreviews-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
