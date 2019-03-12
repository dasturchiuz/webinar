<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\product\Sklad */

$this->title = Yii::t('app', 'Создать Sklad');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sklads'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sklad-create">

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
            </div>
        </div>

</div>
