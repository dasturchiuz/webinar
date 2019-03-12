<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\Profile */

$this->title = Yii::t('app', 'Редактировать: ' . $model->fullnameemp, [
    'nameAttribute' => '' . $model->fullnameemp,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Администраторы'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fullnameemp, 'url' => ['view', 'id' => $model->user_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Редактировать');
?>
<div class="profile-update">

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            <span class="label label-primary pull-right"><i class="fa fa-html5"></i></span>
        </div><!-- /.box-header -->
        <div class="box-body">



            <div class="employees-form">

                <?php $form = ActiveForm::begin(); ?>
                <div class="row">
                    <div class="col-md-4">
                        <?= $form->field($model, 'role')->dropDownList([
                            'super_admin'=>'Супер администратор	',
                            'admin'=>'Администратор',
                            'manager'=>'Менеджеры',
                            'regional_managers'=>'Региональные менеджеры',
                            'agent'=>'Агент',
                            'сouriers'=>'Курьеры',
                            'buxgalter'=>"кабинет бухгалтера"
                        ], ['prompt'=>'выберите']) ?>
                    </div>
                    <div class="col-md-4">

                    </div>
                    <div class="col-md-4">

                        <?= $form->field($model, 'region_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Regions::find()->all(), 'id', 'name_obl'), ['prompt'=>'Вибрити']) ?>

                    </div>
                </div>
                <div class="form-group">
                    <?= Html::submitButton('Сохранить ', ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>
