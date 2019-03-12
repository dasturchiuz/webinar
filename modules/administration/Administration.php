<?php

namespace app\modules\administration;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/**
 * administration module definition class
 */
class Administration extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\administration\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        $this->modules = [
//            'imagemanager' => [
//                'class' => 'noam148\imagemanager\Module',
//                //set accces rules ()
//                'canUploadImage' => true,
//                'canRemoveImage' => function(){
//                    return true;
//                },
//                'deleteOriginalAfterEdit' => false, // false: keep original image after edit. true: delete original image after edit
//                // Set if blameable behavior is used, if it is, callable function can also be used
//                'setBlameableBehavior' => false,
//                //add css files (to use in media manage selector iframe)
//                'cssFiles' => [
//                    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css',
//                ],
//            ],
            'filemanager' => [
                'class' => 'pendalf89\filemanager\Module',

            ],
        ];
        if(\app\models\config\UserActions::isBlack()){
            \Yii::$app->session->setFlash('error', 'Вы не можете войти Администратция! Ваш статус заблокирован обратитесь наши агенты');
            return \Yii::$app->response->redirect(['/'])->send();
        }
        // custom initialization code goes here
    }
    public function behaviors(){
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access'=>[
                'class'=>AccessControl::className(),
                'rules'=>[
                    [
                        'allow'=>true,
                        'roles'=>['super_admin', 'admin', 'regional_managers', 'manager', 'buxgalter', 'agent', 'сouriers'],
                    ],

                ],
            ],
        ];
    }
}
