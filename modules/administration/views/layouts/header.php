<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">ALIOR</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

               
                <?php $notify=\app\models\Notfications::find()->where(['profile_id'=>Yii::$app->user->getId(), 'is_read'=>0])->asArray()->all(); ?>
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning"><?=count($notify)?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">У вас есть <?=count($notify)?> уведомлений</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <?php foreach($notify as $item_notify):?>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-users text-aqua"></i> <?=$item_notify['notfy_text']?>
                                    </a>
                                </li>
                                <?php endforeach;?>
<!--                                <li>-->
<!--                                    <a href="#">-->
<!--                                        <i class="fa fa-warning text-yellow"></i> Very long description here that may-->
<!--                                        not fit into the page and may cause design problems-->
<!--                                    </a>-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    <a href="#">-->
<!--                                        <i class="fa fa-users text-red"></i> 5 new members joined-->
<!--                                    </a>-->
<!--                                </li>-->
<!---->
<!--                                <li>-->
<!--                                    <a href="#">-->
<!--                                        <i class="fa fa-shopping-cart text-green"></i> 25 sales made-->
<!--                                    </a>-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    <a href="#">-->
<!--                                        <i class="fa fa-user text-red"></i> You changed your username-->
<!--                                    </a>-->
<!--                                </li>-->
                            </ul>
                        </li>
                        <li class="footer"><a href="#">View all</a></li>
                    </ul>
                </li>

                <?php $user_model = \app\models\Profile::findOne(Yii::$app->user->identity->id);?>
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="hidden-xs"><?=$user_model->lastname." ".$user_model->firstname?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">

                            <p>
                               <strong><?=$user_model->lastname." ".$user_model->firstname?></strong>
                            </p>
                            <p>
                                <?=$user_model->rolename?>
                            </p>
                            <?php if(!empty($user_model->oblast)):?>
                                <p>
                                    <?php //Yii::$app->user->identity->getRegionId();?>
                                    <?=$user_model->oblast->name_obl;?>
                                </p>
                            <?php endif;?>
                        </li>

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="<?=\yii\helpers\Url::to(['/administration/account']);?>" class="btn btn-default btn-flat">Профиль</a>
                            </div>
                            <div class="pull-right">
                                <?= Html::a(
                                    'Выход',
                                    ['/account/logout'],
                                    [ 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>


            </ul>
        </div>
    </nav>
</header>
