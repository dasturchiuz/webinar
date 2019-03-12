<?php

namespace app\modules\administration\controllers;
use Yii;
use app\models\Profile;
use yii\data\ActiveDataProvider;
use app\models\CommentProfile;
use app\models\User;
use yii\helpers\Url;
class AcceptedOrderController extends \yii\web\Controller
{
    public function behaviors(){
        return [
            'access'=>[
                'class'=>\yii\filters\AccessControl::className(),
                'rules'=>[
                    [
                        'allow'=>true,
                        'roles'=>['super_admin', 'admin', 'manager', 'regional_managers', 'agent', 'сouriers'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $session=Yii::$app->session;
        $client="";
        if(Yii::$app->session->hasFlash('profile_id') or $session->has('profile_id')){
            $client=Profile::find()->where(['user_id'=>Yii::$app->session->getFlash('profile_id') !=null ? Yii::$app->session->getFlash('profile_id') : $session->get('profile_id')])->one();
            if($client){
                if( !Yii::$app->user->can('super_admin')){
                    if(!Yii::$app->user->can('IsRegion', ['profile'=>$client])){
                        Yii::$app->session->setFlash('error', 'USER ID: <b>'.$client->usernameid.'</b>  не ваш область');
                        return $this->redirect(['/administration/accepted-order/index']);
                    }
                }
                $comments=new ActiveDataProvider([
                    'query'=>\app\models\CommentProfile::find()->where(['profile_id'=>$client->user_id]),
                    'sort'=> ['defaultOrder' => ['created_at'=>SORT_DESC]]
                ]);

            }else{
                Yii::$app->session->setFlash('error', 'USER ID: <b>'.Yii::$app->session->getFlash('profile_id').'</b>  не существует');
                return $this->redirect(['/administration/accepted-order/index']);
            }
        }

        $model = new \yii\base\DynamicModel(['user_id']);
        $model->addRule(['user_id'], 'string', ['max' => 128]);
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $client_user=User::find()->where(['user_id'=>$model->user_id])->asArray()->one();

            if($client_user){

                $client=Profile::findOne($client_user['id']);
                if( !Yii::$app->user->can('super_admin')){
                    if(!Yii::$app->user->can('IsRegion', ['profile'=>$client])){
                        Yii::$app->session->setFlash('error', 'USER ID: <b>'.$client->usernameid.'</b>  не ваш область');
                        return $this->redirect(['/administration/accepted-order/index']);
                    }
                }
                $comments=new ActiveDataProvider([
                    'query'=>\app\models\CommentProfile::find()->where(['profile_id'=>$client->user_id]),
                    'sort'=> ['defaultOrder' => ['created_at'=>SORT_DESC]]
                ]);

            }else{
                Yii::$app->session->setFlash('error', 'USER ID: <b>'.$model->user_id.'</b>  не существует');
                return $this->redirect(['/administration/accepted-order/index']);
            }
        }
        return $this->render('index', compact('model', 'client', 'comments'));
    }


    public function actionEditComment($comment_id, $user_id){
        $commentProfile=CommentProfile::findOne($comment_id);
        if(Yii::$app->user->can('IsCommentMe', ['comment'=>$commentProfile])){
            if($commentProfile->load(Yii::$app->request->post()) && $commentProfile->save(false)){
                Yii::$app->session->setFlash('success', 'Комментарии успешно редактирован');
                Yii::$app->session->setFlash('profile_id', $user_id );
                return $this->redirect(\yii\helpers\Url::toRoute(['/administration/accepted-order/index']));
            }
            return $this->render('comment_profile_edit', [ 'commentProfile'=>$commentProfile]);
        }else{
            Yii::$app->session->setFlash('error', 'У вас нет разрешений на доступ к этой комментарии');
            Yii::$app->session->setFlash('profile_id', $user_id );
            return $this->redirect(['/administration/accepted-order/index']);
        }

    }

    public function actionDeleteComment($id, $user_id)
    {
        $commentProfile=  \app\models\CommentProfile::findOne($id);
        var_dump($commentProfile);
        die();
        if(Yii::$app->user->can('IsCommentMe', ['comment'=>$commentProfile])){
            $commentProfile->delete();
            Yii::$app->session->setFlash('success', 'Успешно');

            Yii::$app->session->setFlash('profile_id', $user_id );
            return $this->redirect(['/administration/accepted-order/index']);
        }else{
            Yii::$app->session->setFlash('error', 'У вас нет разрешений на доступ к этой комментарии');
            Yii::$app->session->setFlash('profile_id', $user_id );
            return $this->redirect(['/administration/accepted-order/index']);
        }

    }

    public function actionStartorder($profile_id, $type_order){
        $session=Yii::$app->session;
        $session->set('profile_id', $profile_id);
        $session->set('type_order', $type_order);
        return $this->redirect(Url::base('http'));
    }
    public function actionRemoveorder($profile_id, $type_order){
        $session=Yii::$app->session;
        if(Yii::$app->session->has('profile_id') && Yii::$app->session->get('profile_id')==$profile_id ){
            $session->remove('profile_id');
            $session->remove('type_order');
            $session->setFlash('success', "Успешно");
            return $this->redirect(['index']);
        }else{
            $session->setFlash('Error', "Не это USER ID: ".$profile_id);
            return $this->redirect(['index']);
        }


    }



}
