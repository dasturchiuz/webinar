<?php
/**
 * Created by PhpStorm.
 * User: Root
 * Date: 21.04.2018
 * Time: 16:16
 */

namespace app\controllers;

use app\models\Orderitem;
use app\models\Orders;
use app\models\Paymethod;
use app\models\Profile;
use Yii;
//use yii\web\Controller;
use app\models\Product;
use app\models\Cart;
//use yii\base\Model;
use yii\filters\AccessControl;

class CartController extends \yii\web\Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),

                'rules' => [
                    [

                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['index', 'addtocart', 'clearcart', 'dellitem'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
        ];
    }


    public function actionIndex()
    {
        //Yii::$app->pusher->push('my-channel', 'my_event', 'hello world');
        $session = Yii::$app->session;
        $session->open();

        $model = new \yii\base\DynamicModel(['cart_item']);
        $model->addRule(['cart_item'], 'safe');
        if ($model->load(Yii::$app->request->post())) {
            foreach ($_POST['DynamicModel']['cart_item'] as $key_id => $qty) {
                $cart = new Cart();
                $cart->addqty($key_id, $qty != 0 ? $qty : 1);
            }

        }
        return $this->render('index', compact('session', 'model'));
    }


    public function actionCheckout()
    {

        if (\app\models\config\UserActions::isBlack()) {
            Yii::$app->session->setFlash('error', 'Вы не можете оформить заказ! Ваш статус заблокирован обратитесь к администратору сайта');
            return $this->redirect(['/']);
        }
        $session = Yii::$app->session;
        $session->open();

        $foydalanuvchi = null;
        //betta administrator orqali zakaz qabul qilish rejalashtirilgan bo'lib sessionga qarab kimni ids
        if (Yii::$app->session->has('profile_id')) {
            $foyda = Profile::findOne(Yii::$app->session->get('profile_id'));
            if ($foyda == null) {
                Yii::$app->session->setFlash('error', 'Bunday login mavjud emas');
                return $this->redirect(['/cart/index']);
            }
            if (\app\models\config\UserActions::isBlack($foyda->user_id)) {
                Yii::$app->session->setFlash('error', 'Вы не можете оформить заказ! Ваш статус заблокирован обратитесь к администратору сайта');
                return $this->redirect(['/']);
            }
            $foydalanuvchi = $foyda;

        } else {
            $foydalanuvchi = Profile::findOne(Yii::$app->user->identity->id);
            if ($foydalanuvchi->status != \app\models\User::STATUS_CHECKED) {
                Yii::$app->session->setFlash('error', 'Вы не можете оформить заказ! Ваш статус еще не активно');
                return $this->redirect(['/']);
            }
            if (\app\models\config\UserActions::isBlack($foydalanuvchi->user_id)) {
                Yii::$app->session->setFlash('error', 'Вы не можете оформить заказ! Ваш статус заблокирован обратитесь к администратору сайта');
                return $this->redirect(['/']);
            }
        }
        $model = new Orders();
        if ($model->load(Yii::$app->request->post())) {

            $con = Yii::$app->db; // yXHpmfp3<:)G2k[S
            try {
                $transaction = $con->beginTransaction();
                $cart_items = \app\models\Cart::getCartItemsBySeller();
                foreach ($cart_items as $seller_id => $product) {
                    $model_order = new Orders();
                    $model_order->user_id = $foydalanuvchi->user_id;
                    $model_order->order_type = Yii::$app->session->has('type_order') ? Yii::$app->session->get('type_order') : 3;
                    $model_order->region_id = $foydalanuvchi->region_id;
                    $model_order->seller_id = $seller_id;

                    $model_order->delivery_method = $model->delivery_method;
                    $model_order->sum = \app\models\Cart::getCartBySellerSum($product);
                    $model_order->qty = count($product);
                    $model_order->pay_method_name = Paymethod::findOne($model->pay_method_id)->pay_name;

                    if ($flag = $model_order->save(false)) {
                        foreach ($product as $id => $item) {
                            $order_item = new Orderitem();
                            $order_item->order_id = $model_order->id;
                            $order_item->product_id = $id;
                            $order_item->name = $item['name'];
                            $order_item->discount_procent = $item['discount_procent'];
                            $order_item->discount_name = $item['discount_name'];
                            $order_item->price = $item['price'];
                            $order_item->discount_id = $item['discount_id'];
                            $order_item->qty_item = $item['qty'];
                            $order_item->summ_item = $item['qty'] * $item['price'];
                            if (!($flag = $order_item->save(false))) {
                                $transaction->rollBack();

                            }

                        }
                    }
                }
                if (!empty($model->custom_commenttext)) {
                    $com = new \app\models\CommentProfile();
                    $com->com_text = $model->custom_commenttext;
                    $com->profile_id = $foydalanuvchi->user_id;
                    if (!($flag = $com->save(false))) {
                        $transaction->rollBack();
                        Yii::$app->session->setFlash('error', 'ERROR');

                        return $this->redirect(['/']);
                    }
                }

                if ($flag) {
                    $transaction->commit();
                    unset($_SESSION['cart']);
                    $session->remove('type_order');
                    $session->remove('profile_id');
                    unset($_SESSION['cart.qty']);
                    unset($_SESSION['cart.sum']);
                    Yii::$app->session->setFlash('success', 'Успешно оформелено!');
                    return $this->redirect(['/']);
                }
            } catch (\Exception $e) {
                $transaction->rollBack();
            }
        }

        return $this->render('checkout', compact('session', 'model', 'foydalanuvchi'));

    }

    public function actionCheckoutBySeller($sellerid)
    {

        if (\app\models\config\UserActions::isBlack()) {
            Yii::$app->session->setFlash('error', 'Вы не можете оформить заказ! Ваш статус заблокирован обратитесь к администратору сайта');
            return $this->redirect(['/']);
        }
        $session = Yii::$app->session;
        $session->open();

        $foydalanuvchi = null;
        //betta administrator orqali zakaz qabul qilish rejalashtirilgan bo'lib sessionga qarab kimni ids
        if (Yii::$app->session->has('profile_id')) {
            $foyda = Profile::findOne(Yii::$app->session->get('profile_id'));
            if ($foyda == null) {
                Yii::$app->session->setFlash('error', 'Bunday login mavjud emas');
                return $this->redirect(['/cart/index']);
            }
            if (\app\models\config\UserActions::isBlack($foyda->user_id)) {
                Yii::$app->session->setFlash('error', 'Вы не можете оформить заказ! Ваш статус заблокирован обратитесь к администратору сайта');
                return $this->redirect(['/']);
            }
            $foydalanuvchi = $foyda;

        } else {
            $foydalanuvchi = Profile::findOne(Yii::$app->user->identity->id);
            if ($foydalanuvchi->status != \app\models\User::STATUS_CHECKED) {
                Yii::$app->session->setFlash('error', 'Вы не можете оформить заказ! Ваш статус еще не активно');
                return $this->redirect(['/']);
            }
            if (\app\models\config\UserActions::isBlack($foydalanuvchi->user_id)) {
                Yii::$app->session->setFlash('error', 'Вы не можете оформить заказ! Ваш статус заблокирован обратитесь к администратору сайта');
                return $this->redirect(['/']);
            }
        }
        $model = new Orders();
        if ($model->load(Yii::$app->request->post())) {

            $con = Yii::$app->db;
            try {
                $transaction = $con->beginTransaction();
                $cart_items = \app\models\Cart::getCartItemsBySeller($sellerid);

//                foreach ($cart_items as $seller_id => $product) {
                    $model_order = new Orders();
                    $model_order->user_id = $foydalanuvchi->user_id;
                    $model_order->order_type = Yii::$app->session->has('type_order') ? Yii::$app->session->get('type_order') : 3;
                    $model_order->region_id = $foydalanuvchi->region_id;
                    $model_order->seller_id = $sellerid;

                    $model_order->delivery_method = $model->delivery_method;
                    $model_order->sum = \app\models\Cart::getCartBySellerSum($cart_items);
                    $model_order->qty = count($cart_items);
                    $model_order->pay_method_name = Paymethod::findOne($model->pay_method_id)->pay_name;

                    if ($flag = $model_order->save(false)) {
                        foreach ($cart_items as $id => $item) {
                            $order_item = new Orderitem();
                            $order_item->order_id = $model_order->id;
                            $order_item->product_id = $id;
                            $order_item->name = $item['name'];
                            $order_item->discount_procent = $item['discount_procent'];
                            $order_item->discount_name = $item['discount_name'];
                            $order_item->price = $item['price'];
                            $order_item->discount_id = $item['discount_id'];
                            $order_item->qty_item = $item['qty'];
                            $order_item->summ_item = $item['qty'] * $item['price'];
                            if (!($flag = $order_item->save(false))) {
                                $transaction->rollBack();

                            }

                        }
                    }
//                }
                if (!empty($model->custom_commenttext)) {
                    $com = new \app\models\CommentProfile();
                    $com->com_text = $model->custom_commenttext;
                    $com->profile_id = $foydalanuvchi->user_id;
                    if (!($flag = $com->save(false))) {
                        $transaction->rollBack();
                        Yii::$app->session->setFlash('error', 'ERROR');

                        return $this->redirect(['/']);
                    }
                }

                if ($flag) {
                    $transaction->commit();
                    unset($_SESSION['cart']);
                    $session->remove('type_order');
                    $session->remove('profile_id');
                    unset($_SESSION['cart.qty']);
                    unset($_SESSION['cart.sum']);
                    Yii::$app->session->setFlash('success', 'Успешно оформелено!');
                    return $this->redirect(['/']);
                }
            } catch (\Exception $e) {
                echo "<pre>";
                var_dump($e);
                echo "</pre>";
                $transaction->rollBack();
            }
        }

        return $this->render('checkoutbyseller', compact('session', 'model', 'foydalanuvchi', 'sellerid'));

    }

    public function actionCartcount()
    {
        if (!empty($_SESSION['cart'])) {
            return count($_SESSION['cart']);
        } else {
            return 0;
        }
    }

    public function actionAddtocart()
    {
        $id = Yii::$app->request->get('id');
        $qty = (int)Yii::$app->request->get('qty');
        $qty = !$qty ? 1 : $qty;
        $product = Product::findOne($id);
        if (empty($product)) {
            return false;
        }
        if ($product->amount < $qty) {
            $datareturn['sts'] = 1;
            return json_encode($datareturn);
        }

        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->addToCart($product, $qty);
        $this->layout = false;
        $datareturn['res']['sts'] = 0;
        $datareturn['res'] = $this->render('cart-modal', compact('session'));
        if (!empty($_SESSION['cart'])) {
            $datareturn['count'] = count($_SESSION['cart']);
        } else {
            $datareturn['count'] = 0;
        }
        return json_encode($datareturn);

    }

    public function actionClearcart()
    {
        $session = Yii::$app->session;
        $session->open();
        $session->remove('cart');
        $session->remove('cart.qty');
        $session->remove('cart.sum');
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }

    public function actionDellitem()
    {
        $id = Yii::$app->request->get('id');
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->recalc($id);
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }

    public function actionPay($delevery_id)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $delevery = \app\models\DeliveryMethod::findOne($delevery_id);
        if ($delevery->delevery_type == 1) {
            $pay = \app\models\Paymethod::find()->where(['delivery_id' => $delevery->id, 'payment_status' => 1])->asArray()->all();
            if (empty($pay)) {
                $data['status'] = 2;//pay biriktirilmagan
                return $data;
            }

            $d = "";
            foreach ($pay as $item) {
                $d .= '<label><input type="radio" name="Orders[pay_method_id]" value="' . $item['id'] . '"> ' . $item['pay_name'] . '</label>';
            }

            $data['status'] = 1;
            $data['pay'] = $d;
            return $data;
        } else {
            $pay = \app\models\Paymethod::find()->where(['payment_status' => 1])->asArray()->all();
            if (empty($pay)) {
                $data['status'] = 2;//pay biriktirilmagan
                return $data;
            }

            $d = "";
            foreach ($pay as $item) {
                $d .= '<label><input type="radio" name="Orders[pay_method_id]" value="' . $item['id'] . '"> ' . $item['pay_name'] . '</label>';
            }

            $data['status'] = 1;
            $data['pay'] = $d;
            return $data;
        }
    }


}