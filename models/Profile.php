<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use \yii\db\ActiveRecord;
use yii\helpers\Url;

/**
 * This is the model class for table "{{%profile}}".
 *
 * @property int $user_id
 * @property string $firstname
 * @property string $lastname
 * @property string $fathername
 * @property string $tell
 * @property string $role
 * @property string $adress
 * @property int $is_juridical
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $user
 */
class Profile extends \yii\db\ActiveRecord
{
    public $username;
    public $login;
    public $password;
    public $password_conf;
    public $email;
    public $fullname;
    const SCENARIO_CREATE='create';
    const SCENARIO_IMAGE='img';
    const SCENARIO_REGIONAL_MANAGER='REGMANAGER';
    public $vipstatus;
    public $order_date;
    public $user_image;

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

        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['update'] = ['username', 'password', 'password_conf', 'email', 'fullname', 'role'];//Scenario Values Only Accepted
        $scenarios[self::SCENARIO_REGIONAL_MANAGER] = ['username', 'password', 'password_conf', 'email',  'firstname', 'lastname', 'fathername', 'tell',  'adress', 'region_id'];//Scenario Values Only Accepted
        $scenarios[self::SCENARIO_IMAGE] = ['user_image'];//Scenario Values Only Accepted
        return $scenarios;
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%profile}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'created_by', 'login'], 'safe'],
            [['username', 'password', 'password_conf', 'email',  'role'], 'required', 'on'=> self::SCENARIO_CREATE],
            [['user_image'], 'required', 'on'=> self::SCENARIO_IMAGE],
            [['user_image'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
            [['username', 'password', 'password_conf', 'email',  'firstname', 'lastname', 'fathername', 'tell',  'adress'], 'required', 'on'=> self::SCENARIO_REGIONAL_MANAGER],
            [['firstname', 'lastname', 'region_id',  'tell',  'adress', ], 'required'],
            [['user_id', 'is_juridical', 'status', 'created_at', 'updated_at', 'region_id'], 'integer'],
            [['firstname', 'lastname', 'fathername', 'tell', 'role', 'name_magazin'], 'string', 'max' => 32],
            [['adress'], 'string', 'max' => 200],
            //[['user_id'], 'unique'],
            //[['user_id'], 'exist', 'skipOnError' => false, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            ['username', 'checkLogin'],
            ['email', 'checkEmail'],
            ['password_conf','checkPass'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('app', 'User ID'),
            'firstname' => Yii::t('app', 'Имя'),
            'lastname' => Yii::t('app', 'Фамилия'),
            'fathername' => Yii::t('app', 'Отчество'),
            'tell' => Yii::t('app', 'Телефон'),
            'role' => Yii::t('app', 'Уровень'),
            'adress' => Yii::t('app', 'Адрес'),
            'is_juridical' => Yii::t('app', 'Ваш статус'),
            'status' => Yii::t('app', 'Ваш статус'),
            'region_id' => Yii::t('app', 'Область'),
            'email' => Yii::t('app', 'Эл. адрес'),
            'password_conf' => Yii::t('app', 'Повтор пароля'),
            'password' => Yii::t('app', 'Пароль'),
            'created_at' => Yii::t('app', 'Создан в'),
            'updated_at' => Yii::t('app', 'Обновлено на'),
            'username' => Yii::t('app', 'Пользователь'),
            'created_by' => Yii::t('app', 'созданный'),
            'vipstatus' => Yii::t('app', 'VIP-статус'),
            'brand_juridical' => Yii::t('app', 'Бренд'),
            'name_magazin' => Yii::t('app', '(другое название) юр. лицо'),
//            'market_id' => Yii::t('app', 'Торговая площадка'),
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    //region userlarni role va regin buyicha id sini olish
    public static function getIds($role, $region_id){
        if($region_id!=null)
            $data=['role'=>$role, 'region_id'=>$region_id];
        else
            $data=['role'=>$role];
        $region_agents=  \app\models\Profile::find()->where($data)->select('user_id')->asArray()->all();
        if(empty($region_agents)){
            return false;
        }
        $agents_id=[];
        foreach($region_agents as $agents){
            $agents_id[]=intval($agents['user_id']);
        }
        return $agents_id;
    }



    //get client курьер
    public function getCourier(){
        //$modelCourier=\app\models\WeeksClientList::find()->where(['client_id'=>$id, 'user_id'=>$сouriersIds, 'role_type'=>\app\models\WeeksClientList::ROLE_COURER])->one();
        return $this->hasOne(
            \app\models\WeeksClientList::className(), ['client_id'=>'user_id']
        )->onCondition(['role_type'=>\app\models\WeeksClientList::ROLE_COURER]);
    }
    //get magazin star
    public function getStar(){
        return Yii::$app->db->createCommand("SELECT AVG(pr.star_rating) as star FROM product pt LEFT JOIN product_reviews pr ON pr.product_id=pt.id  WHERE pt.user_id='".$this->user_id."'")->queryOne()['star'];
    }
    //get otziv count
    public function getStarCount(){
        return Yii::$app->db->createCommand("SELECT count(*) as count FROM product_reviews pr LEFT JOIN product pt ON pt.id=pr.product_id  WHERE pt.user_id='".$this->user_id."'")->queryOne()['count'];
    }



    //get client агент
    public function getAgent(){
        //$modelCourier=\app\models\WeeksClientList::find()->where(['client_id'=>$id, 'user_id'=>$сouriersIds, 'role_type'=>\app\models\WeeksClientList::ROLE_COURER])->one();
        return $this->hasOne(
            \app\models\WeeksClientList::className(), ['client_id'=>'user_id']
        )->onCondition(['role_type'=>\app\models\WeeksClientList::ROLE_AGENT]);
    }

    public function getJuridic()
    {
        return $this->hasOne(Juridical::className(), ['profile_id' => 'user_id']);
    }
    public function getMarketplace()
    {
        return $this->hasOne(\app\models\Marketplace::className(), ['id' => 'market_id']);
    }

    //zakazlarini olish
    public function getOrders()
    {
        return $this->hasMany(\app\models\Orders::className(), ['user_id' => 'user_id']);
    }

    public function getWeeks()
    {
        return $this->hasMany(\app\models\WeeksClientList::className(), ['client_id' => 'user_id']);
    }

    public function getDebit()
    {
        return $this->hasMany(\app\models\Debitor::className(), ['profile_id' => 'user_id']);
    }

    
    //yuridik shahsni olish
    public function getJuridical()
    {
        return $this->hasOne(Juridical::className(), ['profile_id' => 'user_id']);
    }
    //adresni olish
    public function getAdresess()
    {
        return $this->hasOne(\app\models\Adresses::className(), ['profile_id' => 'user_id']);
    }

    public function getManzil(){
        $adr=$this->adresess;
        return isset($adr) ? $adr->strana->strana_name.", ".$adr->oblast->name_obl.", ".$adr->city->city_name.", <br> ".$adr->street.", ".$adr->house.", ".$adr->room.",<br>  Ориентир: ".$adr->orientir : "Нет адрес";
    }
    public function getManzilschyot(){
        $adr=$this->adresess;
        return isset($adr) ? $adr->strana->strana_name.", ".$adr->oblast->name_obl.", ".$adr->city->city_name.", ".$adr->street.", ".$adr->house.", ".$adr->room  : "Нет адрес";
    }


    public function getComent(){
        return $this->hasMany(\app\models\CommentProfile::className(), ['profile_id' => 'user_id']);
    }

    public function getComment(){
        $comment=$this->coment;
        if(!empty($comment))
        {
            return  "<a href='".Url::toRoute([$this->role !='client' ? '/administration/clientjuridical/comment-profile/' : '/administration/client/comment-profile/', 'profile_id'=>$this->user_id])."'style='color: #34ce57;'>Есть</a>";
        }else{
            return "<a href='".Url::toRoute([$this->role !='client' ? '/administration/clientjuridical/comment-profile/' : '/administration/client/comment-profile/', 'profile_id'=>$this->user_id])."'>Нет</a>";
        }
    }


        public function getCommentin(){
        $comment=$this->coment;
        if(!empty($comment))
        {
            return  "<span style='color: #000000;'>Есть</span>";
        }else{
            return  "<span style='color: #000000;'>Нет</span>";
        }
    }



    public function getCreatedby()
    {
        return $this->hasOne(Profile::className(), ['id' => 'created_by']);
    }
    


    public function getOblast()
    {
        return $this->hasOne(Regions::className(), ['id'=>'region_id']);
    }
    public function getLogo()
    {
        return $this->hasOne(UserImages::className(), ['user_id'=>'user_id']);
    }

    public function checkLogin($attribute, $params)
    {
        $connection = \Yii::$app->db;
        $model = $connection->createCommand("SELECT COUNT(*) FROM user WHERE username = '".$this->username."'; '");

        $users_count = $model->queryScalar();
        if($users_count!=0)
        {
            $this->addError($attribute, 'Login mavjud');
        }
    }

    public function checkEmail($attribute, $params)
    {
        $connection = \Yii::$app->db;
        $model = $connection->createCommand("SELECT COUNT(*) FROM user WHERE email = '".$this->email."'; '");

        $users_count = $model->queryScalar();
        if($users_count!=0)
        {
            $this->addError($attribute, 'Этот E-Mail уже используется');
        }
    }

    public function getUsernameid(){
        $dat=$this->user;
        if(!empty($dat))
        {
            return $dat->user_id;
        }else{
            return "";
        }
    }

    public function getUserimg(){
        return $this->hasOne(\app\models\UserImages::className(), ['user_id' => 'user_id']);
    }

    public function getFullnameemp()
    {
        return $this->firstname." ".$this->lastname." ".$this->fathername;
    }

    public function getRolename()
    {
        $user_massiv= [
            'super_admin'=>'Супер администратор	',
            'admin'=>'Администратор',
            'buxgalter'=>"кабинет бухгалтера",
            'manager'=>'Менеджеры',
            'regional_managers'=>'Региональные менеджеры',
            'agent'=>'Агент',
            'client'=>'Физическое лицо',
            'client_juridical'=>'Юридическое лицо',
            'сouriers'=>'Курьеры'
        ];
        if(!empty($this->role))
            return $user_massiv[$this->role];
        else
            return "неизвестный пользователь";
    }


    public function checkPass($attribute, $params)
    {
        if($this->password!=$this->password_conf)
            $this->addError($attribute, "Parolni tekshiring!");
    }
    //zakazchik ne billarni chiqarish
    public function getIsnocustomer($agent_id){
        $dd=\app\models\NoCustomers::find()->where(['client_id'=>$this->user_id, 'is_archive'=>'0', 'created_by'=>$agent_id ,"DATE(FROM_UNIXTIME(created_at))"=>date('Y-m-d')])->asArray()->all();
        if(count($dd)>0)
            return true;
        else
            return false;
    }
    //statis uchun orderlarni status buyicha sonini chiqarish
    public static function getStatisdiagram($user_id, $clien_tip, $date){
        if(empty($date))
            $date="CURDATE() - INTERVAL 7 DAY";
       return Yii::$app->db->createCommand("SELECT
      (SELECT COUNT(*) FROM `orders` `o` LEFT JOIN `weeks_client_list` `w` ON `o`.`user_id`=`w`.`client_id` LEFT JOIN profile p ON p.user_id=w.client_id WHERE `w`.`user_id`=".$user_id." and p.role='".$clien_tip."' and DATE(FROM_UNIXTIME(o.created_at)) BETWEEN ".$date." and CURDATE()) as all_orders,
 (SELECT COUNT(*) FROM `orders` `o` LEFT JOIN `weeks_client_list` `w` ON `o`.`user_id`=`w`.`client_id` LEFT JOIN profile p ON p.user_id=w.client_id WHERE `w`.`user_id`=".$user_id." and p.role='".$clien_tip."' and o.status=10 and DATE(FROM_UNIXTIME(o.created_at)) BETWEEN ".$date." and CURDATE()) as notdelivered_orders,
 (SELECT COUNT(*) FROM `orders` `o` LEFT JOIN `weeks_client_list` `w` ON `o`.`user_id`=`w`.`client_id` LEFT JOIN profile p ON p.user_id=w.client_id WHERE `w`.`user_id`=".$user_id." and p.role='".$clien_tip."' and o.status=11 and DATE(FROM_UNIXTIME(o.created_at)) BETWEEN ".$date." and CURDATE()) as purchase_orders,
 (SELECT COUNT(*) FROM `orders` `o` LEFT JOIN `weeks_client_list` `w` ON `o`.`user_id`=`w`.`client_id` LEFT JOIN profile p ON p.user_id=w.client_id WHERE `w`.`user_id`=".$user_id." and p.role='".$clien_tip."' and o.status=12 and DATE(FROM_UNIXTIME(o.created_at)) BETWEEN ".$date." and CURDATE()) as debt_orders,
 (SELECT COUNT(*) FROM `orders` `o` LEFT JOIN `weeks_client_list` `w` ON `o`.`user_id`=`w`.`client_id` LEFT JOIN profile p ON p.user_id=w.client_id WHERE `w`.`user_id`=".$user_id." and p.role='".$clien_tip."' and o.status=13 and DATE(FROM_UNIXTIME(o.created_at)) BETWEEN ".$date." and CURDATE()) as refused_orders,
 (SELECT COUNT(*) FROM `orders` `o` LEFT JOIN `weeks_client_list` `w` ON `o`.`user_id`=`w`.`client_id` LEFT JOIN profile p ON p.user_id=w.client_id WHERE `w`.`user_id`=".$user_id." and p.role='".$clien_tip."' and o.status=14 and DATE(FROM_UNIXTIME(o.created_at)) BETWEEN ".$date." and CURDATE()) as paidnotdelivered_orders
FROM profile p WHERE p.user_id=".$user_id." ")->queryOne();
    }

    //statis uchun orderlarni status buyicha summasini chiqarish
    public static function getStatissum($user_id, $clien_tip, $date){
        if(empty($date))
            $date="CURDATE() - INTERVAL 7 DAY";
       return Yii::$app->db->createCommand("SELECT
      (SELECT SUM(o.sum) FROM `orders` `o` LEFT JOIN `weeks_client_list` `w` ON `o`.`user_id`=`w`.`client_id` LEFT JOIN profile p ON p.user_id=w.client_id WHERE `w`.`user_id`=".$user_id." and p.role='".$clien_tip."' and DATE(FROM_UNIXTIME(o.created_at)) BETWEEN ".$date." and CURDATE()) as all_orders,
 (SELECT SUM(o.sum) FROM `orders` `o` LEFT JOIN `weeks_client_list` `w` ON `o`.`user_id`=`w`.`client_id` LEFT JOIN profile p ON p.user_id=w.client_id WHERE `w`.`user_id`=".$user_id." and p.role='".$clien_tip."' and o.status=10 and DATE(FROM_UNIXTIME(o.created_at)) BETWEEN ".$date." and CURDATE()) as notdelivered_orders,
 (SELECT SUM(o.sum) FROM `orders` `o` LEFT JOIN `weeks_client_list` `w` ON `o`.`user_id`=`w`.`client_id` LEFT JOIN profile p ON p.user_id=w.client_id WHERE `w`.`user_id`=".$user_id." and p.role='".$clien_tip."' and o.status=11 and DATE(FROM_UNIXTIME(o.created_at)) BETWEEN ".$date." and CURDATE()) as purchase_orders,
 (SELECT SUM(o.sum) FROM `orders` `o` LEFT JOIN `weeks_client_list` `w` ON `o`.`user_id`=`w`.`client_id` LEFT JOIN profile p ON p.user_id=w.client_id WHERE `w`.`user_id`=".$user_id." and p.role='".$clien_tip."' and o.status=12 and DATE(FROM_UNIXTIME(o.created_at)) BETWEEN ".$date." and CURDATE()) as debt_orders,
 (SELECT SUM(o.sum) FROM `orders` `o` LEFT JOIN `weeks_client_list` `w` ON `o`.`user_id`=`w`.`client_id` LEFT JOIN profile p ON p.user_id=w.client_id WHERE `w`.`user_id`=".$user_id." and p.role='".$clien_tip."' and o.status=13 and DATE(FROM_UNIXTIME(o.created_at)) BETWEEN ".$date." and CURDATE()) as refused_orders,
 (SELECT SUM(o.sum) FROM `orders` `o` LEFT JOIN `weeks_client_list` `w` ON `o`.`user_id`=`w`.`client_id` LEFT JOIN profile p ON p.user_id=w.client_id WHERE `w`.`user_id`=".$user_id." and p.role='".$clien_tip."' and o.status=14 and DATE(FROM_UNIXTIME(o.created_at)) BETWEEN ".$date." and CURDATE()) as paidnotdelivered_orders
FROM profile p WHERE p.user_id=".$user_id." ")->queryOne();
    }
    //zakazchikka borgan vaqtdagi bor yoki yuqligini chiqaradi
    public static function getZakazchik($user_id, $client_tip, $date){
        if(empty($date))
            $date="CURDATE() - INTERVAL 7 DAY";

        return Yii::$app->db->createCommand("SELECT
(SELECT COUNT(*) FROM no_customers nc LEFT JOIN `profile` `p` ON p.user_id=nc.client_id LEFT JOIN `weeks_client_list` `w` ON `p`.`user_id` = `w`.`client_id` WHERE (`w`.`user_id`=".$user_id.") and (nc.status=1) and (p.role='".$client_tip."') and DATE(FROM_UNIXTIME(nc.created_at)) BETWEEN ".$date." and CURDATE()) as nebil,

(SELECT COUNT(*) FROM no_customers nc LEFT JOIN `profile` `p` ON p.user_id=nc.client_id LEFT JOIN `weeks_client_list` `w` ON `p`.`user_id` = `w`.`client_id` WHERE (`w`.`user_id`=".$user_id.") and (nc.status=2) and (p.role='".$client_tip."')  and DATE(FROM_UNIXTIME(nc.created_at)) BETWEEN ".$date." and CURDATE()) as nezakazal")->queryOne();
    }

    //barcha, activ va blokdagi clientlarni soniini chiqarish AGENT uchun
    public static function getAlllitso($user_id, $client_tip){
        return Yii::$app->db->createCommand("SELECT
    (SELECT count(*) as all_yurlitso FROM `profile` `p` LEFT JOIN `weeks_client_list` `w` ON `p`.`user_id` = `w`.`client_id` WHERE `w`.`user_id`=pp.user_id and p.role='".$client_tip."' ) AS all_yurlitso,
    (SELECT count(*) as all_yurlitso FROM `profile` `p` LEFT JOIN `weeks_client_list` `w` ON `p`.`user_id` = `w`.`client_id` WHERE `w`.`user_id`=pp.user_id and p.role='".$client_tip."' and (p.status=10) ) AS all_active_yurlitso, (SELECT count(*) as all_block_yurlitso FROM `profile` `p` LEFT JOIN `weeks_client_list` `w` ON `p`.`user_id` = `w`.`client_id` WHERE `w`.`user_id`=pp.user_id and p.role='".$client_tip."' and (p.status=20) ) AS all_block_yurlitso
    FROM profile pp WHERE user_id=".$user_id)->queryOne();
    }

    /***********************************************************************ADMIN ADMIN ADMIN *************************/
    //barcha, activ va blokdagi clientlarni soniini chiqarish ADMIN uchun
    /**
     * 1. -Количество торговых точек:
     * 2. Количество обслуживаемых торговых точек
     * 3. Чёрный список
     */
    /**
     * @param $user_id
     * @param $client_tip
     * @return mixed
     */
    public static function getAlllitsoByAdmin($user_id, $client_tip){
        return Yii::$app->db->createCommand("SELECT
    (SELECT count(*) FROM profile WHERE region_id = p.region_id and role='".$client_tip."' ) as all_yurlitso,
    (SELECT count(*) FROM profile WHERE status=10 and region_id = p.region_id and role='".$client_tip."' ) as all_active_yurlitso,
    (SELECT count(*) FROM profile WHERE status=20 and region_id = p.region_id and role='".$client_tip."' ) as all_block_yurlitso
    FROM profile p WHERE p.user_id='".$user_id."';")->queryOne();
    }

    //statis uchun orderlarni status buyicha sonini chiqarish ADMIN
    /** 1. all zakaz
     * 2. Не доставленые заказы
     * 3. Закупка
     * 4. Закупили в долг
     * 5. Отказались закупаться
     * 6. Оплаченные и не доставленные заказы
     * @param $user_id
     * @param $clien_tip
     * @param $date
     * @return mixed
     */
    public static function getStatisdiagramByAdmin($user_id, $clien_tip, $date){
        if(empty($date))
            $date="CURDATE() - INTERVAL 7 DAY";
        return Yii::$app->db->createCommand("SELECT
    (SELECT count(*) FROM orders o LEFT JOIN profile p ON o.user_id=p.user_id WHERE p.region_id=jj.region_id and p.role='".$clien_tip."' and DATE(FROM_UNIXTIME(o.created_at)) BETWEEN '2018-07-07' and CURDATE()) as all_orders,
     (SELECT count(*) FROM orders o LEFT JOIN profile p ON o.user_id=p.user_id WHERE p.region_id=jj.region_id and o.status=10 and p.role='".$clien_tip."' and  DATE(FROM_UNIXTIME(o.created_at)) BETWEEN '".$date."' and CURDATE()) as notdelivered_orders,
     (SELECT count(*) FROM orders o LEFT JOIN profile p ON o.user_id=p.user_id WHERE p.region_id=jj.region_id and o.status=11 and p.role='".$clien_tip."' and  DATE(FROM_UNIXTIME(o.created_at)) BETWEEN '".$date."' and CURDATE()) as purchase_orders,
     (SELECT count(*) FROM orders o LEFT JOIN profile p ON o.user_id=p.user_id WHERE p.region_id=jj.region_id and o.status=12 and p.role='".$clien_tip."' and  DATE(FROM_UNIXTIME(o.created_at)) BETWEEN '".$date."' and CURDATE()) as debt_orders,
     (SELECT count(*) FROM orders o LEFT JOIN profile p ON o.user_id=p.user_id WHERE p.region_id=jj.region_id and o.status=13 and p.role='".$clien_tip."' and  DATE(FROM_UNIXTIME(o.created_at)) BETWEEN '".$date."' and CURDATE()) as refused_orders,
      (SELECT count(*) FROM orders o LEFT JOIN profile p ON o.user_id=p.user_id WHERE p.region_id=jj.region_id and o.status=14 and p.role='".$clien_tip."' and  DATE(FROM_UNIXTIME(o.created_at)) BETWEEN '".$date."' and CURDATE()) as paidnotdelivered_orders

FROM profile jj WHERE jj.user_id=".$user_id." ;")->queryOne();
    }

    //zakazchikka borgan vaqtdagi bor yoki yuqligini chiqaradi
    /**
     * @param $user_region
     * @param $client_tip
     * @param $date
     * @return mixed
     */
    public static function getZakazchikAdmin($user_region, $client_tip, $date){
        if(empty($date))
            $date="CURDATE() - INTERVAL 7 DAY";

        return Yii::$app->db->createCommand("SELECT
(SELECT COUNT(*) FROM no_customers nc LEFT JOIN `profile` `p` ON p.user_id=nc.client_id WHERE (nc.status=1) and (p.role='".$client_tip."') and (p.region_id='".$user_region."') and DATE(FROM_UNIXTIME(nc.created_at)) BETWEEN ".$date." and CURDATE()) as nebil,

(SELECT COUNT(*) FROM no_customers nc LEFT JOIN `profile` `p` ON p.user_id=nc.client_id WHERE (nc.status=2) and (p.role='".$client_tip."') and (p.region_id='".$user_region."') and DATE(FROM_UNIXTIME(nc.created_at)) BETWEEN ".$date." and CURDATE()) as nezakazal")->queryOne();
    }

    //statis uchun orderlarni status buyicha summasini chiqarish
    /**
     * @param $user_id
     * @param $clien_tip
     * @param $date
     * @return mixed
     */
    public static function getStatissumAdmin($user_id, $clien_tip, $date){
        if(empty($date))
            $date="CURDATE() - INTERVAL 7 DAY";
        return Yii::$app->db->createCommand("SELECT
(SELECT SUM(o.sum) FROM `orders` `o` LEFT JOIN profile p ON p.user_id=o.user_id WHERE p.region_id=jj.region_id and p.role='".$clien_tip."' and DATE(FROM_UNIXTIME(o.created_at)) BETWEEN ".$date." and CURDATE()) as all_orders,
(SELECT SUM(o.sum) FROM `orders` `o` LEFT JOIN profile p ON p.user_id=o.user_id WHERE p.region_id=jj.region_id and p.role='".$clien_tip."' and o.status=10 and  DATE(FROM_UNIXTIME(o.created_at)) BETWEEN ".$date." and CURDATE()) as notdelivered_orders,
(SELECT SUM(o.sum) FROM `orders` `o` LEFT JOIN profile p ON p.user_id=o.user_id WHERE p.region_id=jj.region_id and p.role='".$clien_tip."' and o.status=11 and  DATE(FROM_UNIXTIME(o.created_at)) BETWEEN ".$date." and CURDATE()) as purchase_orders,
(SELECT SUM(o.sum) FROM `orders` `o` LEFT JOIN profile p ON p.user_id=o.user_id WHERE p.region_id=jj.region_id and p.role='".$clien_tip."' and o.status=12 and  DATE(FROM_UNIXTIME(o.created_at)) BETWEEN ".$date." and CURDATE()) as debt_orders,
(SELECT SUM(o.sum) FROM `orders` `o` LEFT JOIN profile p ON p.user_id=o.user_id WHERE p.region_id=jj.region_id and p.role='".$clien_tip."' and o.status=13 and  DATE(FROM_UNIXTIME(o.created_at)) BETWEEN ".$date." and CURDATE()) as refused_orders,
(SELECT SUM(o.sum) FROM `orders` `o` LEFT JOIN profile p ON p.user_id=o.user_id WHERE p.region_id=jj.region_id and p.role='".$clien_tip."' and o.status=14 and  DATE(FROM_UNIXTIME(o.created_at)) BETWEEN ".$date." and CURDATE()) as paidnotdelivered_orders
FROM profile jj WHERE jj.user_id=".$user_id." ")->queryOne();
    }

    /*************************END ADMIN ***************************/


/***********************************************************************SUPER ADMIN ADMIN ADMIN *************************/
    //barcha, activ va blokdagi clientlarni soniini chiqarish ADMIN uchun
    /**
     * 1. -Количество торговых точек:
     * 2. Количество обслуживаемых торговых точек
     * 3. Чёрный список
     */
    /**
     * @param $user_id
     * @param $client_tip
     * @return mixed
     */
    public static function getAlllitsoBySuperAdmin($client_tip){
        return Yii::$app->db->createCommand("SELECT
    (SELECT count(*) FROM profile WHERE region_id = p.region_id and role='".$client_tip."' ) as all_yurlitso,
    (SELECT count(*) FROM profile WHERE status=10 and region_id = p.region_id and role='".$client_tip."' ) as all_active_yurlitso,
    (SELECT count(*) FROM profile WHERE status=20 and region_id = p.region_id and role='".$client_tip."' ) as all_block_yurlitso
    FROM profile p WHERE p.role='".$client_tip."';")->queryOne();
    }

    //statis uchun orderlarni status buyicha sonini chiqarish ADMIN
    /** 1. all zakaz
     * 2. Не доставленые заказы
     * 3. Закупка
     * 4. Закупили в долг
     * 5. Отказались закупаться
     * 6. Оплаченные и не доставленные заказы
     * @param $user_id
     * @param $clien_tip
     * @param $date
     * @return mixed
     */
    public static function getStatisdiagramBySuperAdmin( $clien_tip, $date){
        if(empty($date))
            $date="CURDATE() - INTERVAL 7 DAY";
        return Yii::$app->db->createCommand("SELECT
    (SELECT count(*) FROM orders o LEFT JOIN profile p ON o.user_id=p.user_id WHERE p.region_id=jj.region_id and p.role='".$clien_tip."' and DATE(FROM_UNIXTIME(o.created_at)) BETWEEN '2018-07-07' and CURDATE()) as all_orders,
     (SELECT count(*) FROM orders o LEFT JOIN profile p ON o.user_id=p.user_id WHERE p.region_id=jj.region_id and o.status=10 and p.role='".$clien_tip."' and  DATE(FROM_UNIXTIME(o.created_at)) BETWEEN '".$date."' and CURDATE()) as notdelivered_orders,
     (SELECT count(*) FROM orders o LEFT JOIN profile p ON o.user_id=p.user_id WHERE p.region_id=jj.region_id and o.status=11 and p.role='".$clien_tip."' and  DATE(FROM_UNIXTIME(o.created_at)) BETWEEN '".$date."' and CURDATE()) as purchase_orders,
     (SELECT count(*) FROM orders o LEFT JOIN profile p ON o.user_id=p.user_id WHERE p.region_id=jj.region_id and o.status=12 and p.role='".$clien_tip."' and  DATE(FROM_UNIXTIME(o.created_at)) BETWEEN '".$date."' and CURDATE()) as debt_orders,
     (SELECT count(*) FROM orders o LEFT JOIN profile p ON o.user_id=p.user_id WHERE p.region_id=jj.region_id and o.status=13 and p.role='".$clien_tip."' and  DATE(FROM_UNIXTIME(o.created_at)) BETWEEN '".$date."' and CURDATE()) as refused_orders,
      (SELECT count(*) FROM orders o LEFT JOIN profile p ON o.user_id=p.user_id WHERE p.region_id=jj.region_id and o.status=14 and p.role='".$clien_tip."' and  DATE(FROM_UNIXTIME(o.created_at)) BETWEEN '".$date."' and CURDATE()) as paidnotdelivered_orders

FROM profile jj WHERE jj.role='".$clien_tip."' ;")->queryOne();
    }

    //zakazchikka borgan vaqtdagi bor yoki yuqligini chiqaradi
    /**
     * @param $user_region
     * @param $client_tip
     * @param $date
     * @return mixed
     */
    public static function getZakazchikSuperAdmin($client_tip, $date){
        if(empty($date))
            $date="CURDATE() - INTERVAL 7 DAY";

        return Yii::$app->db->createCommand("SELECT
(SELECT COUNT(*) FROM no_customers nc LEFT JOIN `profile` `p` ON p.user_id=nc.client_id WHERE (nc.status=1) and (p.role='".$client_tip."')  and DATE(FROM_UNIXTIME(nc.created_at)) BETWEEN ".$date." and CURDATE()) as nebil,

(SELECT COUNT(*) FROM no_customers nc LEFT JOIN `profile` `p` ON p.user_id=nc.client_id WHERE (nc.status=2) and (p.role='".$client_tip."')  and DATE(FROM_UNIXTIME(nc.created_at)) BETWEEN ".$date." and CURDATE()) as nezakazal")->queryOne();
    }

    //statis uchun orderlarni status buyicha summasini chiqarish
    /**
     * @param $user_id
     * @param $clien_tip
     * @param $date
     * @return mixed
     */
    public static function getStatissumSuperAdmin( $clien_tip, $date){
        if(empty($date))
            $date="CURDATE() - INTERVAL 7 DAY";
        return Yii::$app->db->createCommand("SELECT
(SELECT SUM(o.sum) FROM `orders` `o` LEFT JOIN profile p ON p.user_id=o.user_id WHERE p.region_id=jj.region_id and p.role='".$clien_tip."' and DATE(FROM_UNIXTIME(o.created_at)) BETWEEN ".$date." and CURDATE()) as all_orders,
(SELECT SUM(o.sum) FROM `orders` `o` LEFT JOIN profile p ON p.user_id=o.user_id WHERE p.region_id=jj.region_id and p.role='".$clien_tip."' and o.status=10 and  DATE(FROM_UNIXTIME(o.created_at)) BETWEEN ".$date." and CURDATE()) as notdelivered_orders,
(SELECT SUM(o.sum) FROM `orders` `o` LEFT JOIN profile p ON p.user_id=o.user_id WHERE p.region_id=jj.region_id and p.role='".$clien_tip."' and o.status=11 and  DATE(FROM_UNIXTIME(o.created_at)) BETWEEN ".$date." and CURDATE()) as purchase_orders,
(SELECT SUM(o.sum) FROM `orders` `o` LEFT JOIN profile p ON p.user_id=o.user_id WHERE p.region_id=jj.region_id and p.role='".$clien_tip."' and o.status=12 and  DATE(FROM_UNIXTIME(o.created_at)) BETWEEN ".$date." and CURDATE()) as debt_orders,
(SELECT SUM(o.sum) FROM `orders` `o` LEFT JOIN profile p ON p.user_id=o.user_id WHERE p.region_id=jj.region_id and p.role='".$clien_tip."' and o.status=13 and  DATE(FROM_UNIXTIME(o.created_at)) BETWEEN ".$date." and CURDATE()) as refused_orders,
(SELECT SUM(o.sum) FROM `orders` `o` LEFT JOIN profile p ON p.user_id=o.user_id WHERE p.region_id=jj.region_id and p.role='".$clien_tip."' and o.status=14 and  DATE(FROM_UNIXTIME(o.created_at)) BETWEEN ".$date." and CURDATE()) as paidnotdelivered_orders
FROM profile jj WHERE jj.role='".$clien_tip."'; ")->queryOne();
    }

    /*************************END ADMIN ***************************/





}
