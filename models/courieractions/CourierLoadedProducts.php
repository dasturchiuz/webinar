<?php

namespace app\models\courieractions;


use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\AttributeBehavior;
use \yii\db\ActiveRecord;


/**
 * This is the model class for table "{{%courier_loaded_products}}".
 *
 * @property int $id
 * @property int $product_id
 * @property string $product_price
 * @property int $courier_id
 * @property int $qty_loaded
 * @property int $qty
 * @property int $remnant
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 * @property int $status
 */
class CourierLoadedProducts extends \yii\db\ActiveRecord
{
    const STATUS_NEW=1;
    const STATUS_ACCEPTED=2;
    const STATUS_COMPLETED=3;
    public $amount;
    public static function Statuses(){
        return [
          self::STATUS_NEW=>"Ещё не одобрено курьером",
          self::STATUS_ACCEPTED=>"Принято курьером",
          self::STATUS_COMPLETED=>"Завершено",
        ];
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
                    ActiveRecord::EVENT_BEFORE_INSERT=>['created_by', 'updated_by'],
                    ActiveRecord::EVENT_BEFORE_UPDATE=>['updated_by'],
                ],
                'value'=>function(){ return Yii::$app->user->identity->id;},
            ],
            [
                'class'=>AttributeBehavior::className(),
                'attributes'=>[
                    ActiveRecord::EVENT_BEFORE_INSERT=>['status'],
                ],
                'value'=>function(){ return self::STATUS_NEW;},
            ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%courier_loaded_products}}';
    }

    public function rules()
    {
        return [
            [['product_id', 'product_price', 'price_item', 'courier_id', 'prname', 'qty_loaded', ], 'required'],
            [['product_id', 'courier_id', 'qty_loaded', 'qty', 'remnant', 'created_at', 'created_by', 'updated_by', 'status', 'updated_at'], 'integer'],
            [['prname'], 'string', 'max'=>'255'],
            [['product_price'], 'number'],

        ];
    }


//    public function checkLogin($attribute, $params)
//    {
//        $connection = \Yii::$app->db;
//        $model = $connection->createCommand("SELECT COUNT(*) FROM user WHERE username = '".$this->username."'; '");
//
//        $users_count = $model->queryScalar();
//        if($users_count!=0)
//        {
//            $this->addError($attribute, 'Login mavjud');
//        }
//    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'product_price' => Yii::t('app', 'Product Price'),
            'courier_id' => Yii::t('app', 'Courier ID'),
            'qty_loaded' => Yii::t('app', 'Qty Loaded'),
            'qty' => Yii::t('app', 'Qty'),
            'remnant' => Yii::t('app', 'Remnant'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'status' => Yii::t('app', 'Status'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'prname' => Yii::t('app', 'prname At'),
            'price_item' => Yii::t('app', 'price_item At'),
        ];
    }

    public function getProfile(){
        return $this->hasOne(\app\models\Profile::className(), ['user_id'=>'courier_id']);
    }

    public function getProduct(){
        return $this->hasOne(\app\models\Product::className(), ['id'=>'product_id']);
    }

    public function getCount(){
        return $this->product->amount;
    }

}
