<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\AttributeBehavior;
use \yii\db\ActiveRecord;
use app\models\Orderitem;
/**
 * This is the model class for table "{{%orders}}".
 *
 * @property int $id
 * @property string $created_at
 * @property string $updated_at
 * @property int $qty
 * @property double $sum
 * @property int $user_id
 * @property int $region_id
 * @property string $firstname
 * @property string $lastname
 * @property string $adress
 * @property string $phone
 * @property string $email
 * @property int $pay_status
 * @property string $pay_method_name
 * @property int $pay_method_id
 * @property string $note
 * @property int $status
 * @property int $termsofuse
 *
 * @property OrderItem[] $orderItems
 * @property Regions $region
 * @property Profile $user
 */
class Orders extends ActiveRecord
{
    public $termsofuse;
    const STATUS_NEW = 10; //Не доставленые заказы
    const STATUS_ZAKUPKA=11;//Закупка
    const STATUS_ZAKUPKA_DOLG=12;//Закупили в долг
    const STATUS_ZAKUPKA_OTKAZ=13;//Отказались закупаться
    const STATUS_OPLACHEN_NO_DASTAVLEN=14;//Оплаченные и не доставленные заказы
    const STATUS_DELIVERID=1;//Оплаченные и не доставленные заказы
    const STATUS_NODELEVER=0;//Оплаченные и не доставленные заказы



    const STATUS_PENDING_PAYMENT = 20;
    const STATUS_PROCESSING = 30;
    const STATUS_FAILED = 40;
    const STATUS_ON_HOLD = 50;
    const STATUS_REFUNDED = 60;
    const STATUS_COMPLETED = 70;
    const STATUS_COURER = 80;
    const STATUS_NULL = 0;
    const SCENARIO_COURER='courer';



    public $custom_dastavkanaimiya;

    public $custom_commenttext;
    public $ddate;

    public function scenarios(){
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_COURER]=['courier_id'];
        return $scenarios;
    }


    public function behaviors(){
        return [
            [
                'class'=>TimestampBehavior::className(),
                'attributes'=>[
                    ActiveRecord::EVENT_BEFORE_INSERT=>['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE=>['updated_at'],
                ],
                'value'=>function(){ return date('U');},
            ],
            [
                'class'=>AttributeBehavior::className(),
                'attributes'=>[
                    ActiveRecord::EVENT_BEFORE_INSERT=>['pay_status'],
                ],
                'value' => function ($event) {
                    return self::STATUS_PENDING_PAYMENT;
                },
            ],
            [
                'class'=>AttributeBehavior::className(),
                'attributes'=>[
                    ActiveRecord::EVENT_BEFORE_INSERT=>['status'],
                ],
                'value' => function ($event) {
                    return self::STATUS_NEW;
                },
            ],[
                'class'=>AttributeBehavior::className(),
                'attributes'=>[
                    ActiveRecord::EVENT_BEFORE_INSERT=>['delivery_status'],
                ],
                'value' => function ($event) {
                    return self::STATUS_NODELEVER;
                },
            ],
            [
                'class'=>AttributeBehavior::className(),
                'attributes'=>[
                    ActiveRecord::EVENT_BEFORE_INSERT=>['created_by'],
                ],
                'value' => function ($event) {
                    return Yii::$app->user->getId();
                },
            ],
            [
                'class'=>AttributeBehavior::className(),
                'attributes'=>[
                    ActiveRecord::EVENT_BEFORE_INSERT=>['is_read'],
                ],
                'value' => function ($event) {
                    return 0;
                },
            ],

        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%orders}}';
    }


    public static function getStatuses()
    {
        return [
            self::STATUS_NEW => 'Не доставленые заказы',
            self::STATUS_ZAKUPKA => 'Закупка',
            self::STATUS_ZAKUPKA_DOLG => 'Закупили в долг',
            self::STATUS_ZAKUPKA_OTKAZ => 'Отказались закупаться',
            self::STATUS_OPLACHEN_NO_DASTAVLEN =>'Оплаченные и не доставленные заказы' ,
            self::STATUS_PENDING_PAYMENT =>'Платеж в ожидании' ,
        ];
    }

    
    public static function getTipzakaz()
    {
        return [
            1 => 'Принял заказ',
            2 => 'Добавлений заказ',
            3 => 'Клиент сам заказал',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'custom_commenttext', 'delivery_status','deliver_sklad'], 'safe'],
            [['qty', 'user_id', 'pay_status', 'pay_method_id', 'status', 'termsofuse', 'courier_id', 'created_by', 'delivery_method', 'order_type', 'seller_id', 'is_read'], 'integer'],
            [['sum'], 'number'],
            [['delivery_date'], 'date'],
            [['pay_method_name'], 'string', 'max' => 50],
            ['termsofuse', 'required',  'requiredValue' => 1, 'message' => 'Вы не ознакомились с условиями пользования
'],
            ['pay_method_id', 'required',   'message' => 'Выберите способ оплаты'],
            ['delivery_method', 'required',   'message' => 'Выберите условия доставки'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['user_id' => 'user_id']],
            [['seller_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['seller_id' => 'user_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Номер заказа'),
            'created_at' => Yii::t('app', 'Дата создания'),
            'updated_at' => Yii::t('app', 'Обновлено на'),
            'qty' => Yii::t('app', 'Количество товаров'),
            'sum' => Yii::t('app', 'Сумма заказа'),
            'user_id' => Yii::t('app', 'Клиент ИД'),
            'order_type' => Yii::t('app', 'Типь заказ'),
            'deliver_sklad' => Yii::t('app', 'Склад'),

            'pay_status' => Yii::t('app', 'Оплата'),
            'pay_method_name' => Yii::t('app', 'Метод оплаты'),
            'pay_method_id' => Yii::t('app', 'метод оплаты'),
            'is_read' => Yii::t('app', 'примечание'),
            'status' => Yii::t('app', 'Статус'),
            'courier_id' => Yii::t('app', 'Курьер'),
            'termsofuse' => Yii::t('app', 'Условия пользования'),
            'delivery_method' => Yii::t('app', 'Условия доставки'),
            'custom_dastavkanaimiya' => Yii::t('app', 'Доставка на имя и адрес'),
            'created_by' => Yii::t('app', 'Агент'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(Orderitem::className(), ['order_id' => 'id']);
    }

    public function getOrderHistoryStatus(){
        return $this->hasMany(OrderStatusHistory::className(), ['order_id'=>'id']);
    }

    public static function SellerNewOrdersCount($seller_id, $sts){
        return Orders::find()->where(['seller_id'=>$seller_id, 'is_read'=>$sts])->count();
    }
    //Продавец не обработал заказ
    public static function SellerNewOrdersNotCount($seller_id, $sts){
        return Orders::find()->where(['seller_id'=>$seller_id, 'status'=>self::STATUS_NEW])->count();
    }



    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourier()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'courier_id']);
    }

    //sotuvchini olish
    public function getSeller()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'seller_id']);
    }

    public function getAgent()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'created_by']);
    }

    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'user_id']);
    }

    public function getWeek()
    {
        return $this->hasOne(\app\models\WeeksClientList::className(), ['client_id' => 'user_id']);
    }

    public function getWeeks()
    {
        return $this->hasMany(\app\models\WeeksClientList::className(), ['client_id' => 'user_id']);
    }

    public function getDebit()
    {
        return $this->hasMany(\app\models\Debitor::className(), ['profile_id' => 'user_id']);
    }

    public function getDelivery()
    {
        return $this->hasOne(\app\models\DeliveryMethod::className(), ['id' => 'delivery_method']);
    }

    public function getUser()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'user_id']);
    }

    public static function Propis($num)
    {
        // Все варианты написания чисел прописью от 0 до 999 скомпануем в один небольшой массив
        $m = [
            ['ноль'],
            ['-', 'один', 'два', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять'],
            ['десять', 'одиннадцать', 'двенадцать', 'тринадцать', 'четырнадцать', 'пятнадцать', 'шестнадцать', 'семнадцать', 'восемнадцать', 'девятнадцать'],
            ['-', '-', 'двадцать', 'тридцать', 'сорок', 'пятьдесят', 'шестьдесят', 'семьдесят', 'восемьдесят', 'девяносто'],
            ['-', 'сто', 'двести', 'триста', 'четыреста', 'пятьсот', 'шестьсот', 'семьсот', 'восемьсот', 'девятьсот'],
            ['-', 'одна', 'две']
        ];
        // Все варианты написания разрядов прописью скомпануем в один небольшой массив
        $r = [
            ['...ллион', '', 'а', 'ов'], // используется для всех неизвестно больших разрядов
            ['тысяч', 'а', 'и', ''],
            ['миллион', '', 'а', 'ов'],
            ['миллиард', '', 'а', 'ов'],
            ['триллион', '', 'а', 'ов'],
            ['квадриллион', '', 'а', 'ов'],
            ['квинтиллион', '', 'а', 'ов']
            // ,array(... список можно продолжить
        ];
        if ($num == 0) return $m[0][0]; # Если число ноль, сразу сообщить об этом и выйти
        $o = []; # Сюда записываем все получаемые результаты преобразования
        # Разложим исходное число на несколько трехзначных чисел и каждое полученное такое число обработаем отдельно
        foreach (array_reverse(str_split(str_pad($num, ceil(strlen($num) / 3) * 3, '0', STR_PAD_LEFT), 3)) as $k => $p) {
            $o[$k] = [];
            # Алгоритм, преобразующий трехзначное число в строку прописью
            foreach ($n = str_split($p) as $kk => $pp)
                if (!$pp) continue; else
                    switch ($kk) {
                        case 0:
                            $o[$k][] = $m[4][$pp];
                            break;
                        case 1:
                            if ($pp == 1) {
                                $o[$k][] = $m[2][$n[2]];
                                break 2;
                            } else$o[$k][] = $m[3][$pp];
                            break;
                        case 2:
                            if (($k == 1) && ($pp <= 2)) $o[$k][] = $m[5][$pp]; else$o[$k][] = $m[1][$pp];
                            break;
                    }
            $p *= 1;
            if (!$r[$k]) $r[$k] = reset($r);
            # Алгоритм, добавляющий разряд, учитывающий окончание руского языка
            if ($p && $k)switch (true) {
                case preg_match("/^[1]$|^\d*[0,2-9][1]$/", $p):
                    $o[$k][] = $r[$k][0] . $r[$k][1];
                    break;
                case preg_match("/^[2-4]$|\d*[0,2-9][2-4]$/", $p):
                    $o[$k][] = $r[$k][0] . $r[$k][2];
                    break;
                default:
                    $o[$k][] = $r[$k][0] . $r[$k][3];
                    break;
            }
            $o[$k] = implode(' ', $o[$k]);
        }
        return implode(' ', array_reverse($o));
    }
    public static  function num2str($num) {
        $nul='ноль';
        $ten=array(
            array('','один','два','три','четыре','пять','шесть','семь', 'восемь','девять'),
            array('','одна','две','три','четыре','пять','шесть','семь', 'восемь','девять'),
        );
        $a20=array('десять','одиннадцать','двенадцать','тринадцать','четырнадцать' ,'пятнадцать','шестнадцать','семнадцать','восемнадцать','девятнадцать');
        $tens=array(2=>'двадцать','тридцать','сорок','пятьдесят','шестьдесят','семьдесят' ,'восемьдесят','девяносто');
        $hundred=array('','сто','двести','триста','четыреста','пятьсот','шестьсот', 'семьсот','восемьсот','девятьсот');
        $unit=array( // Units
            array('копейка' ,'копейки' ,'тийин',	 1),
            array('рубль'   ,'рубля'   ,'сум'    ,0),
            array('тысяча'  ,'тысячи'  ,'тысяч'     ,1),
            array('миллион' ,'миллиона','миллионов' ,0),
            array('миллиард','милиарда','миллиардов',0),
        );
        //
        list($rub,$kop) = explode('.',sprintf("%015.2f", floatval($num)));
        $out = array();
        if (intval($rub)>0) {
            foreach(str_split($rub,3) as $uk=>$v) { // by 3 symbols
                if (!intval($v)) continue;
                $uk = sizeof($unit)-$uk-1; // unit key
                $gender = $unit[$uk][3];
                list($i1,$i2,$i3) = array_map('intval',str_split($v,1));
                // mega-logic
                $out[] = $hundred[$i1]; # 1xx-9xx
                if ($i2>1) $out[]= $tens[$i2].' '.$ten[$gender][$i3]; # 20-99
                else $out[]= $i2>0 ? $a20[$i3] : $ten[$gender][$i3]; # 10-19 | 1-9
                // units without rub & kop
                if ($uk>1) $out[]= self::morph($v,$unit[$uk][0],$unit[$uk][1],$unit[$uk][2]);
            } //foreach
        }
        else $out[] = $nul;
        $out[] = self::morph(intval($rub), $unit[1][0],$unit[1][1],$unit[1][2]); // rub
        $out[] = $kop.' '.self::morph($kop,$unit[0][0],$unit[0][1],$unit[0][2]); // kop
        return trim(preg_replace('/ {2,}/', ' ', join(' ',$out)));
    }

    /**
     * Склоняем словоформу
     * @ author runcore
     */
    private function morph($n, $f1, $f2, $f5) {
        $n = abs(intval($n)) % 100;
        if ($n>10 && $n<20) return $f5;
        $n = $n % 10;
        if ($n>1 && $n<5) return $f2;
        if ($n==1) return $f1;
        return $f5;
    }
}
