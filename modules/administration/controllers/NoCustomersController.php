<?php

namespace app\modules\administration\controllers;
use Yii;
use app\models\Profile;
use app\models\ProductSearch;
use app\models\Product;
use app\models\Cart;
use yii\data\ActiveDataProvider;
use app\models\CommentProfile;
use app\models\User;
use yii\helpers\Url;
use yii\filters\VerbFilter;

class NoCustomersController extends \yii\web\Controller
{


    public function behaviors()
    {
        return [
            'access'=>[
                'class'=>\yii\filters\AccessControl::className(),
                'rules'=>[
                    [
                        'allow'=>true,
                        'roles'=>['super_admin', 'admin', 'regional_managers', 'manager', 'buxgalter', 'agent', 'сouriers'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    /**
     * Agar orderesda aynan shu id ga teng bo'lgan zakaz va shu kunga tog'ri kelgan bo'lsa no customer jadvalidan olib tashlansin
     */

    public function actionClientby($client_id)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => \app\models\NoCustomers::find()->where(['client_id' => $client_id, 'is_archive'=>'0', 'created_by' => Yii::$app->user->getId()]),
            'sort'=>['defaultOrder'=>['created_at'=>SORT_DESC]],
        ]);
        return $this->render('index', compact('dataProvider'));
    }

    public function actionSetNoCustomer($client_id, $week_number)
    {
        $dd = \app\models\NoCustomers::find()->where(['client_id' => $client_id,'is_archive'=>'0', 'created_by' => Yii::$app->user->getId(), "DATE(FROM_UNIXTIME(created_at))" => date('Y-m-d')])->asArray()->all();
        if (count($dd) > 0) {
            Yii::$app->session->setFlash('error', 'Вы уже посетили этого клиента на сегодня');
            return $this->redirect(['/administration/week/by', 'week_num' => $week_number]);
        }
        $db = Yii::$app->db;
        $transaction = $db->beginTransaction();
        try {
            $customer = new \app\models\NoCustomers();
            $customer->client_id = $client_id;
            $customer->status = \app\models\NoCustomers::STATUS_NO;
            $customer->save(false);
            $transaction->commit();
            Yii::$app->session->setFlash('success', 'Успешно');
            return $this->redirect(['/administration/week/by', 'week_num' => $week_number]);
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        } catch (\Throwable $e) {
            $transaction->rollBack();
        }


    }

    public function actionDelete($id){
        $zakaz=\app\models\NoCustomers::findOne($id);
        $zakaz->is_archive=1;
        if($zakaz->save(false)){
            Yii::$app->session->setFlash('success', 'Успешно');
            return $this->redirect(Yii::$app->request->referrer);
        }else
        {
            Yii::$app->session->setFlash('error', 'Ошибка');
            return $this->redirect(Yii::$app->request->referrer);
        }
    }

    public function actionNoCustomerComment($client_id, $week_number)
    {
        $customer = new \app\models\NoCustomers();
        $comment = new \app\models\CommentProfile();
        $dd = \app\models\NoCustomers::find()->where(['client_id' => $client_id,'is_archive'=>'0', 'created_by' => Yii::$app->user->getId(), "DATE(FROM_UNIXTIME(created_at))" => date('Y-m-d')])->asArray()->all();
        if (count($dd) > 0) {
            Yii::$app->session->setFlash('error', 'Вы уже посетили этого клиента на сегодня');
            return $this->redirect(['/administration/week/by', 'week_num' => $week_number]);
        }
        if ($comment->load(Yii::$app->request->post())) {
            $db = Yii::$app->db;
            $transaction = $db->beginTransaction();
            try {
                if ($comment->save(false)) {
                    $customer->client_id = $client_id;
                    $customer->comment_id = $comment->id;
                    $customer->status = \app\models\NoCustomers::STATUS_YES;
                    $customer->save(false);
                    $transaction->commit();
                    Yii::$app->session->setFlash('success', 'Успешно');
                    return $this->redirect(['/administration/week/by', 'week_num' => $week_number]);
                } else {
                    $transaction->rollBack();
                    Yii::$app->session->setFlash('success', 'Ошибка давай ещё раз повторить');
                    return $this->redirect(['/administration/week/by', 'week_num' => $week_number]);
                }
            } catch (\Exception $e) {
                $transaction->rollBack();
                throw $e;
            } catch (\Throwable $e) {
                $transaction->rollBack();
            }

        }
        return $this->render('setcustomerno', compact('comment', 'week_number'));
    }

}

