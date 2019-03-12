<?php

namespace app\models;

use Yii;
use zabachok\behaviors\SluggableBehavior;

use yii\web\UploadedFile;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "{{%product}}".
 *
 * @property int $id
 * @property int $category_id
 * @property int $profile_id
 * @property int $amount
 * @property string $related_products PHP serialize
 * @property string $name
 * @property string $code
 * @property string $price
 * @property int $price_protsent
 * @property string $text
 * @property string $short_text
 * @property string $is_new
 * @property string $is_popular
 * @property string $feature_image
 * @property string $available
 * @property int $sort
 * @property string $slug
 */
class Product extends \yii\db\ActiveRecord
{
    public $product_images;
    const STATUS_ON = 10;
    const STATUS_OFF = 0;
    //dillereskiy chast uchun --------------------------------------------+
    //product type
    const PRODUCT_TYPE_SELLER=1;
    const PRODUCT_TYPE_DILLER=2;
    const PRODUCT_TYPE_ALL=3;
    public $type_ads;
    public $price_ads;

    //type ads
    const PRODUCT_TYPEAD_PRADAYU=1;
    const PRODUCT_TYPEAD_PAKUPAYU=2;
    //--------------------------------------------------------------------+
    public static function  getProductTypeADStatus(){
        return [
          self::PRODUCT_TYPEAD_PRADAYU=>"Продаю",
          self::PRODUCT_TYPEAD_PAKUPAYU=>"Покупаю",
        ];
    }

    public static function  getProductTypeStatus(){
        return [
          self::PRODUCT_TYPE_SELLER=>"Показать в магазине",
          self::PRODUCT_TYPE_DILLER=>"Показать у дилера",
          self::PRODUCT_TYPE_ALL=>"Показать везде",
        ];
    }

    public function behaviors(){
        return [
            [
                'class'=>TimestampBehavior::className(),
                'attributes'=>[
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT=>['created_at', 'updated_at'],
                    \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE=>['updated_at'],
                ],
                'value'=>function(){ return date('U');},
            ],
            [
                'class'=>AttributeBehavior::className(),
                'attributes'=>[
                    ActiveRecord::EVENT_BEFORE_INSERT=>['status'],
                ],
                'value' => function ($event) {
                    return self::STATUS_OFF;
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
                'class' => SluggableBehavior::className(),
                'attribute' => 'name',
                // 'slugAttribute' => 'slug',
                'immutable' => true,
                'ensureUnique'=>true,
            ],
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%product}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at','updated_at', 'created_by'], 'safe'],
            [['category_id', 'profile_id', 'amount', 'price_protsent', 'sort', 'manufacturer_id', 'unit_id', 'aproval_id', 'region_id', 'user_id', 'status', 'view_count', 'type_product'], 'integer'],
            [['related_products', 'text', 'is_new', 'product_status', 'is_popular',  'available', 'slug', 'return_guarantee'], 'string'],
            [['name', 'unit_id', 'amount', 'product_status', 'available', 'name', 'category_id', 'type_product'], 'required'],
            [['type_ads', 'price_ads'], 'required', 'when' =>function($model){return $model->type_product==self::PRODUCT_TYPE_DILLER || $model->type_product==self::PRODUCT_TYPE_ALL;}, 'enableClientValidation' => false],
            [['price', 'old_price', 'wholesale_price', 'wholesale_count', 'wholesale_protsent'], 'number'],
            [['product_images'], 'file', 'extensions'=>'png, jpg', 'maxFiles'=>4],
            [['name'], 'string', 'max' => 200],
            [['code'], 'string', 'max' => 155],
            [['slug'], 'string', 'max' => 500],
            ['user_id', 'checkUser']
        ];
    }
    public function checkUser($attribute, $params)
    {
        if(!Yii::$app->user->can('super_admin')){
            $user=\app\models\Profile::findOne($this->user_id);
            if(Yii::$app->user->identity->getRegionId()!=$user->region_id){
                $this->addError($attribute, 'Sizni regioniz foydalanuvchisi emas');
            }
        }
    }
    public function uploadgallery(){
        if($this->validate()){
            foreach($this->product_images as $file){
                $path='uploads/store/' . $file->baseName . '.' . $file->extension;
                $file->saveAs($path);
                $this->attachImage($path);
                @unlink($path);
            }
            return true;
        }else{
            return false;
        }
    }



    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'old_price' => Yii::t('app', 'Старая цена'),
            'wholesale_price' => Yii::t('app', 'Цена оптом'),
            'wholesale_count' => Yii::t('app', 'Минимальное колличество'),
            'category_id' => Yii::t('app', 'Категория'),
            'profile_id' => Yii::t('app', 'Кто добавил'),
            'amount' => Yii::t('app', 'Количество'),
                'related_products' => Yii::t('app', 'Сопутствующие товары'),
            'name' => Yii::t('app', 'Название продукта'),
            'code' => Yii::t('app', 'Код'),
            'price' => Yii::t('app', 'Цена'),
            'price_protsent' => Yii::t('app', 'Цена Проценты'),
            'text' => Yii::t('app', 'Описание'),
            'short_text' => Yii::t('app', 'Краткое описание'),
            'is_new' => Yii::t('app', 'Новый?'),
            'is_popular' => Yii::t('app', 'Популярно?'),
            'product_images' => Yii::t('app', 'Изображение'),
            'main_image' => Yii::t('app', 'Изображение'),
            'available' => Yii::t('app', 'Доступный'),
            'type_product' => Yii::t('app', 'Тип товара'),
            'sort' => Yii::t('app', 'вроде'),
            'manufacturer_id' => Yii::t('app', 'Производитель '),
            'slug' => Yii::t('app', 'Слуг'),
            'unit_id' => Yii::t('app', 'Единица измерения'),
            'aproval_id' => Yii::t('app', 'Одобрение'),
            'region_id' => Yii::t('app', 'Область'),
            'user_id' => Yii::t('app', 'Продавец'),
            'status' => Yii::t('app', 'Статус'),
            'view_count' => Yii::t('app', 'просмотр'),
            'product_status'=>'Cостояние',
            'wholesale_protsent'=>'Проценты оптом',
            'type_ads'=>'Тип диллер товара',
            'price_ads'=>'Цена диллер товара ',
            'return_guarantee' => Yii::t('app', 'Гарантия возврата'),
        ];
    }

    
    public  function getCostdiscount(){
        $skidka=\app\models\Discount::find()->where('now() between date_start  AND date_end AND status=10 AND product_id='.$this->id)->asArray()->one();
        if(!empty($skidka)){
            return $skidka;
        }else{
            return false;
        }
    }

    public function getWithdiscost(){
        if($this->costdiscount!=false)
        {
            return $this->cost - ($this->cost * $this->costdiscount["price_procent"]/100);
        }else{
            return false;
        }
    }
    public function getCartprice(){
        if($this->costdiscount!=false)
        {
            $data['discount_name']=$this->costdiscount["discount_name"];
            $data['discount_procent']=$this->costdiscount["price_procent"];
            $data['discount_id']=$this->costdiscount["id"];
            $data['cost_price']=$this->cost - ($this->cost * $this->costdiscount["price_procent"]/100);
            return $data;
        }else{
            $data['cost_price']=$this->cost - ($this->cost * $this->costdiscount["price_procent"]/100);
            return $data;
        }
    }


//    public function getDis(){
//        return $this->hasOne(\app\models\Discount::className(), ['product_id'=>'id'])->andOnCondition(['now() between date_start  AND date_end AND status=10']);
//    }


    public function getCost(){

        return (($this->price*$this->price_protsent)/100)+$this->price;
    }

    //optom narhni olish va productda chiqarish
    public function getWholesalePrice(){

        return (($this->wholesale_price*$this->wholesale_protsent)/100)+$this->wholesale_price;
    }



    public function getBrand()
    {
        return $this->hasOne(\app\models\Manufacturer::className(), ['id' => 'manufacturer_id']);
    }

    public function getUnit()
    {
        return $this->hasOne(\app\models\Unit::className(), ['id' => 'unit_id']);
    }

    //tasdiqlagan menejer
    public function getAproval()
    {
        return $this->hasOne(\app\models\Profile::className(), ['user_id' => 'aproval_id']);
    }
    
    //tavar qo'shgan foydalanuvchi
    public function getUseradd()
    {
        return $this->hasOne(\app\models\Profile::className(), ['user_id' => 'user_id']);
    }
    //skladni olish
    public function getSklad()
    {
        return $this->hasOne(\app\models\Sklad::className(), ['id' => 'sklad_id']);
    }
    //Kategoriyani olish
    public function getCategory()
    {
        return $this->hasOne(\app\models\Category::className(), ['id' => 'category_id']);
    }

    //Kategoriyani olish
    public function getAddeduser()
    {
        return $this->hasOne(\app\models\Profile::className(), ['user_id' => 'profile_id']);
    }


    //Otzivlarni olish
    public function getReviews(){
        return $this->hasMany(\app\models\Productreviews::className(), ['product_id'=>'id']);
    }


    public function getStar(){
        return Yii::$app->db->createCommand("SELECT AVG(star_rating) as star FROM product_reviews WHERE product_id='".$this->id."'")->queryOne()['star'];
    }
    //product attributlarni olish
    public function getAttrproducts()
    {
        return $this->hasMany(\app\models\Productattr::className(), ['product_id' => 'id']);
    }

    //product skidkalarni olish
    public function getDiscounts()
    {
        return $this->hasMany(\app\models\Discount::className(), ['product_id' => 'id']);
    }
}
