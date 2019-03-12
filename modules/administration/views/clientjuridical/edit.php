<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\widgets\MaskedInput;
use app\models\Regions;
use app\models\Cities;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\Profile */

$this->title = Yii::t('app', 'Редактировать: ' . $model->fullnameemp, [
    'nameAttribute' => '' . $model->fullnameemp,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Клиентский юридический'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fullnameemp, 'url' => ['client-info', 'id' => $model->user_id]];
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
                    <div class="col-md-12">
                        <h3>Редактировать юр. лица</h3>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <h3>ФИО - учредителя</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <?=$form->field($model, 'firstname')->textInput() ?>
                    </div>
                    <div class="col-md-4">
                        <?=$form->field($model, 'lastname')->textInput() ?>
                    </div>
                    <div class="col-md-4">
                        <?=$form->field($model, 'fathername')->textInput() ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <?=$form->field($model, 'tell')->widget(\yii\widgets\MaskedInput::className(), [
                            'mask' => '+999(99)999-9999',
                            'options'=>[
                                'value'=>$model->tell==null ? '+998' : $model->tell ,
                                'class'=>'form-control',
                            ],
                            'clientOptions' => [
                                'autoclear'=>false,
                                'removeMaskOnSubmit' => true,

                            ],
                        ]) ?>
                    </div>
                    <div class="col-md-4">

                        <?=$form->field($model, 'status')->dropDownList(\app\models\User::getStatuses(), ['prompt'=>'Выберите статус']);?>
                    </div>
                    <div class="col-md-4">
                        <?php if(\app\models\User::isSuperAdmin()):?>
                            <?= $form->field($model, 'region_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Regions::find()->all(), 'id', 'name_obl'), ['prompt'=>'Выберите']) ?>
                        <?php endif;?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <?php if(\app\models\User::isSuperAdmin()):?>
                        <?=$form->field($user, 'email')->textInput() ?>
                        <?php endif;?>
                    </div>
                    <div class="col-md-4">

                    </div>
                    <div class="col-md-4">

                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h3>Адрес организации:</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">

                        <?=$form->field($modelAdress, 'strana_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Strana::find()->all(), 'id', 'strana_name'),
                            [
                                'prompt'=>'Выберите',
                                'onchange'=>"$.get('".Url::toRoute('/administration/clientjuridical/oblastlar')."', {strana_id : $(this).val()}).done(function(data){
                         if(data!='1'){
                            $('#adresses-oblast_id').html(data);
                         }
                    });",
                            ]
                        )?>
                    </div>
                    <div class="col-md-3">
                        <?php if($modelAdress->oblast_id!=null):?>
                            <?=$form->field($modelAdress, 'oblast_id')->dropDownList(ArrayHelper::map(Regions::find()->where(['strana_id'=>$modelAdress->strana_id])->asArray()->all(), 'id', 'name_obl'),
                                [
                                    'prompt'=>'Выберите',
                                    'onchange'=>"$.get('".Url::toRoute('/administration/clientjuridical/shaharlar')."', {region_id : $(this).val()}).done(function(data){
                         if(data!='1'){
                            $('#adresses-city_id').html(data);
                         }
                    });",
                                ]
                            ) ?>
                        <?php else: ?>
                            <?=$form->field($modelAdress, 'oblast_id')->dropDownList([],
                                [
                                    'prompt'=>'Выберите',
                                    'onchange'=>"$.get('".Url::toRoute('/administration/clientjuridical/shaharlar')."', {region_id : $(this).val()}).done(function(data){
                         if(data!='1'){
                            $('#adresses-city_id').html(data);
                         }
                    });",
                                ]
                            ) ?>
                        <?php endif;?>

                    </div>
                    <div class="col-md-3">
                        <?php if($modelAdress->oblast!=null):?>
                            <?=$form->field($modelAdress, 'city_id')->dropDownList(ArrayHelper::map(Cities::find()->where(['region_id'=>$modelAdress->oblast_id])->asArray()->all(), 'id', 'city_name'), ['prompt'=>'Выберите'])?>
                        <?php else: ?>
                            <?=$form->field($modelAdress, 'city_id')->dropDownList([], ['prompt'=>'Выберите'])?>
                        <?php endif;?>

                    </div>
                    <div class="col-md-3">
                        <?=$form->field($modelAdress, 'pochta_index')->textInput() ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2">
                        <?=$form->field($modelAdress, 'street')->textInput()?>
                    </div>
                    <div class="col-md-2">
                        <?=$form->field($modelAdress, 'house')->textInput()?>
                    </div>
                    <div class="col-md-2">
                        <?=$form->field($modelAdress, 'room')->textInput()?>
                    </div>

                    <div class="col-md-6">
                        <?=$form->field($modelAdress, 'orientir')->textArea()?>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h3>Реквизиты</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <?=$form->field($modelJuridical, 'inn')->widget(\yii\widgets\MaskedInput::className(), [
                            'mask' => '999999999',
                            'options'=>[
                                'value'=>$modelJuridical->inn,
                                'class'=>'form-control',
                            ],
                            'clientOptions' => [
                                'autoclear'=>false,
                                'removeMaskOnSubmit' => true,

                            ],
                        ]) ?>
                    </div>
                    <div class="col-md-2">
                        <?=$form->field($modelJuridical, 'mfo')->textInput() ?>
                    </div>
                    <div class="col-md-2">
                        <?=$form->field($modelJuridical, 'oked')->textInput()?>

                    </div>
                    <div class="col-md-2">
                        <?=$form->field($modelJuridical, 'okpo')->textInput() ?>
                    </div>
                    <div class="col-md-2">
                        <?=$form->field($modelJuridical, 'coato')->textInput() ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <?=$form->field($modelJuridical, 'bank')->textInput()?>
                    </div>
                    <div class="col-md-2">
                        <?=$form->field($modelJuridical, 'contract_number')->textInput()?>
                    </div>
                    <div class="col-md-3">
                        <?=$form->field($modelJuridical, 'contract_date')->widget(DatePicker::classname(), [
                            'options' => ['placeholder' => 'Enter  date ...'],
                            'value' => date("Y-m-d"),
                            'pluginOptions' => [
                                'autoclose'=>true,
                                'todayBtn' => true,
                                'todayHighlight' => true,
                                'format' => 'yyyy-mm-dd'
                            ]
                        ]);
                        ?>
                    </div>
                    <div class="col-md-4">
                        <?=$form->field($modelJuridical, 'hisobraqam')->widget(\yii\widgets\MaskedInput::className(), [
                            'mask' => '9999.9999.9999.9999.9999',
                            'options'=>[
                                'value'=>$modelJuridical->hisobraqam,
                                'class'=>'form-control',
                            ],
                            'clientOptions' => [
                                'autoclear'=>false,
                                'removeMaskOnSubmit' => true,

                            ],
                        ]) ?>
                    </div>

                </div> 
                <?php if(\app\models\User::isSuperAdmin()):?>
                <div class="row">
                    <div class="col-md-3">
                        <?=$form->field($modelJuridical, 'orgo_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Organization::find()->where(['sts'=>\app\models\Organization::STATUS_ACTIVE])->all(), 'id', 'name'), ['prompt'=>'Выберите'])?>
                    </div>
                    <div class="col-md-2">
                        <?=$form->field($modelJuridical, 'status_shop_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\StatusShop::find()->where(['sts'=>\app\models\StatusShop::STATUS_ACTIVE])->all(), 'id', 'name'), ['prompt'=>'Выберите'])?>
                    </div>
                    <div class="col-md-3">
                        
                    </div>
                    <div class="col-md-4">
                        
                    </div>

                </div>
            <?php endif;?>

                <div class="form-group">
                    <p class="text-right">
                        <?= Html::submitButton('Редактировать ', ['class' => 'btn btn-success']) ?>
                    </p>
                </div>

                <?php ActiveForm::end(); ?>

            </div>

        </div>
    </div>
</div>
