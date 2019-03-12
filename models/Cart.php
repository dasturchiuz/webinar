<?php
/**
 * Created by PhpStorm.
 * User: Root
 * Date: 21.04.2018
 * Time: 16:19
 */

namespace app\models;
//use Yii;
use \yii\base\Model;
//use yii\db\Query;


class Cart  extends Model
{
    public function addToCart($product, $qty=1){
        if(isset($_SESSION['cart'][$product->id])){
            $_SESSION['cart'][$product->id]['qty']+=$qty;
            $_SESSION['cart'][$product->id]['price']=$this->getPrice($product, intval($_SESSION['cart'][$product->id]['qty'])+$qty);
        }else{

            $_SESSION['cart'][$product->id]=[
                'qty'=>$qty,
                'name'=>$product->name,
                'seller_id'=>$product->user_id,
                'slug'=>$product->slug,
                //'зкщвгсе_id'=>$product->id,
                'price'=>$this->getPrice($product, $qty),
                'discount_procent'=>isset($product->cartprice['discount_procent']) ?  $product->cartprice['discount_procent'] : null ,
                'discount_name'=>isset($product->cartprice['discount_name']) ?  $product->cartprice['discount_name'] : null ,
                'discount_id'=>isset($product->cartprice['discount_id']) ?  $product->cartprice['discount_id'] : null ,
                'unit'=>$product->unit->unit_name,
                'img'=>$product->getImage()->getUrl()
            ];
        }
        $this->calcSumma();
    }

    //ayni bir sotuvchining kartdagi umumiy summasini olish
    public static function getCartBySellerSum($product){
        $summ=0;
        foreach ($product as $product_items){
            $summ+=$product_items['qty']*$product_items['price'];
        }
        return $summ;
    }

    //cartdagi maxsulotlarni sotuvchilarini id buyicha olish
    public static function  getSellers(){
        $product_ids=[];
        foreach ($_SESSION['cart'] as $id => $name){
            $product_ids[]=$id;
        }
        if(empty($product_ids)){
            return false;
        }
        return \app\models\Product::find()->select('id, user_id')->where(['in', 'id', $product_ids])->groupBy(['user_id'])->asArray()->all();
    }

    //cartni magazin buyicha saralab olish

    public static function getCartItemsBySeller($seller_id=null){
        if(empty($_SESSION['cart']))
        {
            return false;
        }

        foreach ($_SESSION['cart'] as $key => $item) {
            $data[$item['seller_id']][$key] = $item;
        }
        return $seller_id==null ? $data : $data[$seller_id];
    }
    //seller id buyicha uniig infolarini olish
    //
    public static function getSellerById($id){
        $seller=\app\models\Profile::find()->select('name_magazin, user_id')->where(['user_id'=>$id])->asArray()->one();
        if(empty($seller)){
            return false;
        }
        return $seller;
    }

    //bu function cart dagi tavarlarni sonini va qancha sum bulganini chiqaradi

    protected function calcSumma(){
        $qty=0;
        $sum=0;
        foreach($_SESSION['cart'] as $item){
            $sum=$sum+ ($item['price']*$item['qty']);
            $qty= $qty+$item['qty'];
        }
        $_SESSION['cart.sum']=$sum;
        $_SESSION['cart.qty']=$qty;
    }
    //cart dagi ietmni uchirish uchun xizmat qiladi
    public function recalc($id){
        if(!isset($_SESSION['cart'][$id])) return false;
        unset($_SESSION['cart'][$id]);
        $this->calcSumma();
    }

    //bu funksiya tavarni soniga qarab tan narxini qaytaradi
    /**
     * @param $product
     * @param int $qty
     * @return bool
     */
    protected function getPrice($product, $qty=1){
        if(empty($product)){
            return false;
        }
        if($product->wholesale_price!=0 && $product->wholesale_count<=$qty){
            return $product->wholesale_price+($product->wholesale_price*$product->wholesale_protsent/100);
        }else{
            return $product->price+($product->price*$product->price_protsent/100);
        }
    }
    //bu funksiya ID orqali oladi
    protected function getPriceById($id, $qty){
        $product=\app\models\Product::findOne($id);
        if(empty($product)){
            return false;
        }
        if($product->wholesale_price!=0 && $product->wholesale_count<=$qty){
            return $product->wholesale_price+($product->wholesale_price*$product->wholesale_protsent/100);
        }else{
            return $product->price+($product->price*$product->price_protsent/100);
        }
    }

    public function addqty($id, $qty){
        if(!isset($_SESSION['cart'][$id])) return false;

//        $qtyMinus=$_SESSION['cart'][$id]['qty'];//zakazdan nechta borligi
//        Yii::$app->session->set('cart.qty', (Yii::$app->session->get('cart.qty')-$qtyMinus));
//        $priceMinus=$_SESSION['cart'][$id]['qty'] * $_SESSION['cart'][$id]['price'];
//        $_SESSION['cart.sum']=$_SESSION['cart.sum']-$priceMinus;


        $_SESSION['cart'][$id]['qty']= $qty;
        $_SESSION['cart'][$id]['price']=$this->getPriceById($id, $qty);
        //$pricePlus=$_SESSION['cart'][$id]['qty'] * $_SESSION['cart'][$id]['price'];
//        $_SESSION['cart.sum']+=$pricePlus;
//        $_SESSION['cart.qty']+=$qty;getPriceById
        $this->calcSumma();
        return true;
    }
//adminkadan soni qo'shish uchun order itemga
    public function addqtytoorder($item_id, $qty){
//        $connection = \Yii::$app->db;
//        $transaction = $connection->beginTransaction();
//        try {

            $item=\app\models\Orderitem::findOne($item_id);
            if($item->qty_item!=$qty){
                $order=\app\models\Orders::findOne($item->order_id);
                //ordderdan sonini ayirayapmiz
                $order->qty=($order->qty-$item->qty_item);
                $order->qty=$order->qty+$qty;//sonini qushayapmiz
                //orderdan summasini ayirayapmiz
                $order->sum=$order->sum-$item->summ_item;

                $item->price=$this->getPriceById($item->product_id, $qty);
                $order->sum=$order->sum+($qty*$item->price);
                $order->save(false);
                $item->qty_item=$qty;
                $item->summ_item=$qty*$item->price;
                $item->save();
                return true;
            }
//        } catch(Exception $e) {
//            return false;
//            $transaction->rollback();
//        }
    }
//adminkadan order itemni o'chirish
    public function deleteitem($id){
//        $connection = \Yii::$app->db;
//        $transaction = $connection->beginTransaction();
//        try {
            $item=\app\models\Orderitem::findOne($id);

            $order=\app\models\Orders::findOne($item->order_id);
            $order->qty=($order->qty-$item->qty_item);
            $order->sum=$order->sum-$item->summ_item;
            $order->save(false);
            $item->delete();
            return true;
//        } catch(Exception $e) {
//            $transaction->rollback();
//           // return false;
//        }

    }
//adminkadan qo'shish uchun
    public function addToOrder($product, $order_id){
        $order=\app\models\Orders::findOne($order_id);
        if($order==null){return false;}
        $order_item=new \app\models\Orderitem();
        $order_item->order_id=$order->id;
        $order_item->qty_item=1;
        $order_item->product_id=$product->id;
        $order_item->name=$product->name;
        $order_item->price=$this->getPrice($product,$order_item->qty_item);//$product->cartprice['cost_price'];
        $order_item->summ_item=$this->getPrice($product,$order_item->qty_item);
        $order_item->discount_procent=isset($product->cartprice['discount_procent']) ?  $product->cartprice['discount_procent'] : null;
        $order_item->discount_name=isset($product->cartprice['discount_name']) ?  $product->cartprice['discount_name'] : null;
        $order_item->discount_id=isset($product->cartprice['discount_id']) ?  $product->cartprice['discount_id'] : null;
        if($order_item->save(false)){
            $order->qty=$order->qty+1;
            $order->sum=$order->sum+$order_item->price;
            $order->save(false);
            return true;
        }else{
            return false;
        }
    }
}