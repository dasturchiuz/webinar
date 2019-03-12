<?php

namespace app\modules\administration\controllers;

use yii\web\Controller;

/**
 * Default controller for the `administration` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionLogout()
    {
        Yii::$app->user->logout();
        $this->redirect(Yii::app()->homeUrl.'/administration');
    }
}
