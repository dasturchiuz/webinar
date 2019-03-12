<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\administration\models\DeliveryMethodSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Условия доставки');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="delivery-method-index">
    <div class="row">

        <div class="col-md-12">
            <div class="box box-primary">

                <div class="box-body">
                    <p>
                        <?= Html::a(Yii::t('app', 'Добавить условия доставка'), ['create'], ['class' => 'btn btn-success']) ?>
                    </p>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                      //  'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],


                            'deliver_name',
                            'status',
                            'delevery_type',

                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>

                </div>
            </div>
        </div>


    </div>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


</div>
