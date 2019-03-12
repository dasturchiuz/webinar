<?php

namespace app\modules\administration\controllers;
use app\models\Profile;
use app\models\User;
use Yii;
use app\models\Passwordchange;
use yii\filters\AccessControl;

class AccountController extends \yii\web\Controller
{
    public function behaviors(){
        return [
            'access'=>[
                'class'=>AccessControl::className(),
                'rules'=>[
                    [
                        'actions' => ['index', 'pswd'],
                        'allow'=>true,
                        'roles'=>['super_admin', 'admin', 'regional_managers', 'manager', 'agent', 'сouriers', 'client_juridical'],
                    ],
                    [
                        'actions' => ['index', 'changeuser', 'pswd'],
                        'allow'=>true,
                        'roles'=>['super_admin', 'admin', 'regional_managers', 'manager'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $model=Profile::findOne(Yii::$app->user->getId());
        return $this->render('index', compact('model'));
    }

    //umumiy foydalanuvchilarni parolini o'zgartirish betta shart beramiz
    //1. shart super admin va admin hammasini o'zgartira oladi
    //2. Regionalniy manager o'zini regionidagi manager curier va agentlarni parolini o'zgartira oladi
    //3. manager esa o'zini curear va agentlarini o'zgartira oladi
    public function actionChangeuser($id){
        $profile=\app\models\Profile::findOne($id);
        $model=new Passwordchange(['scenario'=>Passwordchange::SCENARIO_PSWD]);
        if( !Yii::$app->user->can('super_admin')){
            if(!Yii::$app->user->can('IsRegion', ['profile'=>$profile])){
                Yii::$app->session->setFlash('error', 'USER ID: <b>'.$profile->usernameid.'</b>  не ваш область');
                return $this->redirect(['/administration/accepted-order/index']);
            }
        }

        if($model->load(Yii::$app->request->post()) && $model->validate())
        {
            $user=User::findOne($id);
            $user->password_hash=Yii::$app->getSecurity()->generatePasswordHash($model->new_pswd);
            $user->save(false);
            Yii::$app->session->setFlash('success', 'Пароль успешно изменен');
            return $this->redirect(Yii::$app->request->referrer);
        }
        return $this->render('pswduser', compact('model'));
    }


    public function actionPswd(){

        $model=new Passwordchange(['scenario'=>Passwordchange::SCENARIO_PSWD_USER]);
        if($model->load(Yii::$app->request->post()) && $model->validate())
        {
            $user=User::findOne(Yii::$app->user->getId());
            $user->password_hash=Yii::$app->getSecurity()->generatePasswordHash($model->new_pswd);
            $user->save(false);
            Yii::$app->session->setFlash('success', 'Пароль успешно изменен');
            return $this->redirect(Yii::$app->request->referrer);
        }
        return $this->render('pswduser', compact('model'));
    }





}
