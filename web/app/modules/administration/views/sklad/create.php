<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Sklad */

$this->title = Yii::t('app', 'Create Sklad');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sklads'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sklad-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
