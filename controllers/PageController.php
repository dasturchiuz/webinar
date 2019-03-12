<?php
namespace app\controllers;

use Yii;


class PageController extends \yii\web\Controller
{
    public function actions(){
        return [
            'captcha'=>[
                'class'=>'yii\captcha\CaptchaAction'
            ]
        ];
    }

    public function actionSlug($slug){

        $model=\app\models\Article::find()->where(['slug'=>$slug])->one();
        if(!$model){
            Yii::$app->session->setFlash('error', 'Not found exception 404');
            return $this->redirect('/');
        }

        return $this->render('page', compact('model'));
    }


    public function actionContact(){
        $model=new \app\models\ContactOur();
        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $email=Yii::$app->mailer->compose('contact', [
                'client_name'=>$model->client_name,
                'theme_appeal'=>$model->theme_appeal,
                'email'=>$model->email,
                'text_appeal'=>$model->text_appeal,
                'telefon'=>$model->telefon,
            ])
                ->setFrom("info@alior.uz")
                ->setTo("sukhrob3000@mail.ru")
                ->setSubject("Котакт форм")
                ->send();
            if($email){
                Yii::$app->session->setFlash('success', "Успешно! Наши специалисты свяжутся с вами в ближайшее время!");
                return $this->redirect(Yii::$app->request->referrer);
            }else{
                Yii::$app->session->setFlash('error', "Ошибка! Повторите еще раз!");
                return $this->redirect(Yii::$app->request->referrer);
            }
        }

        return $this->render('contact', compact('model'));
    }

}
?>