<?php

use  yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model app\models\Profile */

$this->title = "Привязать к агенту или курьер";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-view">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Привязать к курьер</h3>
                </div><!-- /.box-header -->
                <div class="box-body">


                    <?php $form=ActiveForm::begin(['id'=>'courierForm']);?>

                    <?=$form->field($modelCourier, 'week_number')->dropDownList(\app\models\WeeksName::weeks(), ['prompt'=>'Выберите'])?>
                    <?=$form->field($modelCourier, 'client_id')->hiddenInput(['value'=>$id])->label(false)?>
                    <?php
                    $data=['role'=>'сouriers', 'region_id'=>Yii::$app->user->identity->getRegionId()];
                    if(Yii::$app->user->can('super_admin')){
                        $data=['role'=>'сouriers'];
                    }?>
                    <?=$form->field($modelCourier, 'user_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Profile::find()->where($data)->all(), 'user_id', function($profiles, $defaultValue){
                        return $profiles->lastname.' '.$profiles->firstname.' '.$profiles->fathername.' Логин: '.$profiles->user->username.' Регион: '.$profiles->oblast->name_obl;
                    }), ['prompt'=>'Выберите курьер'])->label("Курьер")?>
                    <?=$form->field($modelCourier, 'status')->hiddenInput(['value'=>'1'])->label(false)?>

                    <div class="form-group">
                        <?= Html::submitButton('Пивязить', ['class' => 'btn btn-primary']) ?>
                    </div>




                </div>
            </div>
            <?php ActiveForm::end();?>
        </div>
    </div>
</div>
