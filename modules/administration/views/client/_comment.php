<?php
use  yii\helpers\Url;
?>
<div class="box box-solid box-success">
    <div class="box-header">
        <h3 class="box-title"><?=$model->kemnapisan?> <small style="color: #fff;">(User ID:
                <?=!empty($model->created->usernameid) ? $model->created->usernameid : ""?> -
                <?=!empty($model->created->rolename) ? $model->created->rolename : "";?>)</small></h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <?=$model->com_text?>
    </div><!-- /.box-body -->
    <div class="box-footer">
        <div class="pull-left"> <?=\Yii::$app->formatter->asDatetime($model->created_at, "php:d-m-Y  H:i:s");
            ?></div>
        <div class="pull-right">
            <a href="<?=Url::toRoute(['/administration/client/edit-comment', 'comment_id'=>$model->id, 'user_id'=>$model->profile_id])?>" class="btn btn-primary">Редактировать</a>
            <a href="<?=Url::toRoute(['/administration/client/delete-comment', 'id'=>$model->id, 'user_id'=>$model->profile_id])?>" class="btn btn-danger">Удалить</a>
        </div>
    </div><!-- /.box-footer-->
</div>