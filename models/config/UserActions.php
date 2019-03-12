<?php
namespace app\models\config;


use Yii;
use app\models\Profile;
use app\models\User;
use app\models\Juridical;
use app\models\Adresses;
use app\models\CommentProfile;
use app\modules\administration\models\RegistrationForm;
use app\modules\administration\models\Regfiz;

class UserActions {
    /*Ushbu klass yurudik va jismoniy shahslar ustida amallar bajarish, ro'yxatdan o'tkazish tahrirlasj uchhun foydalaniladi*/
    public  $registration;

    /**
     * UserActions constructor.
     * @param $_registrationForm
     */
    public function __construct($_registrationForm)
    {
        $this->registration=$_registrationForm;
    }
    //yur litsoni tahrirlash
    /**
     * @param $profile
     * @param $adress
     * @param $juridical
     * @return bool
     */
    public static function editCompony($profile, $adress, $juridical, $user_r=null){
        $connection= \Yii::$app->db;
        $transaction=$connection->beginTransaction(); 
        try{
            $pro=$profile->save(false);
            $user=\app\models\User::findOne($profile->user_id);
            $user->status=$profile->status;
            $user->email=$user_r->email;
            $us=$user->save(false);
            $adr=$adress->save(false);
            $jur=$juridical->save(false);
            if(!$pro && !$adr && !$jur && !$us){
                $transaction->rollback();
                return false;
            }
            $transaction->commit();
            return true;
        }catch(\Exception $e)
        {
            $transaction->rollback();
            return false;
        }
    }
    //fiz litsoni tahirlash
    /**
     * @param $profile
     * @param $adress
     * @return bool
     */
    public static function editProfile($profile, $adress){
        $connection= \Yii::$app->db;
        $transaction=$connection->beginTransaction();
        try{
            $pro=$profile->save(false);
            $adr=$adress->save(false);
            $user=\app\models\User::findOne($profile->user_id);
            $user->status=$profile->status;
            $us=$user->save(false);
            if(!$pro && !$adr && !$us){
                $transaction->rollback();
                return false;
            }
            $transaction->commit();
            return true;
        }catch(\Exception $e)
        {
            $transaction->rollback();
            return false;
        }
    }

    //yurudicheskiy litsoni ruyxatdan o'tkazish
    /**
     * @return bool|string
     */
    public function RegistrationCompony(){
        $connection= \Yii::$app->db;
        $transaction=$connection->beginTransaction();
        $user_model=new \app\models\User();
        $model = new Profile();
        try{
            $user_model->email=$this->registration->email;
            $user_model->telefon=$this->registration->telefon;
            $user_model->status=0;
            $user_model->save(false);

            $model->created_by=Yii::$app->user->getId();
            $user_model->username="UZ".$user_model->id;
            $user_model->user_id="UZ".$user_model->id;
            $user_model->auth_key = \Yii::$app->security->generateRandomString();
            $user_model->save(false);


            $model->user_id=$user_model->id;
            $model->firstname=$this->registration->ism;
            $model->lastname=$this->registration->familiya;
            $model->fathername=$this->registration->otasiningismi;
            $model->tell=$this->registration->telefon;
            $model->role="client_juridical";
            $model->is_juridical=10;
            $model->status=0;
            $model->region_id=$this->registration->oblast;
            $model->email=$this->registration->email;
            //$model->name_magazin=$registration->name_magazin;
            $model->save(false);

            $juridical= new Juridical();
            $juridical->profile_id=$model->user_id;
            $juridical->tashkilot=$this->registration->name_org;
            $juridical->brand_juridical=$this->registration->brand_juridical != null ? $this->registration->brand_juridical : ' ';
            $juridical->bank=$this->registration->bank;
            $juridical->inn=$this->registration->inn;
            $juridical->mfo=$this->registration->mfo;
            $juridical->oked=$this->registration->oked;
            $juridical->status_shop_id=$this->registration->status_shop;
            $juridical->orgo_id=$this->registration->orgonization;
            $juridical->okpo=$this->registration->okpo;
            $juridical->coato=$this->registration->coato;
            $juridical->hisobraqam=$this->registration->rasschyot;
            $juridical->save(false);

            $adresses=new Adresses();

            $adresses->strana_id=$this->registration->strana;
            $adresses->profile_id=$model->user_id;
            $adresses->oblast_id=$this->registration->oblast;
            $adresses->city_id=$this->registration->gorod;
            $adresses->pochta_index=$this->registration->index;
            $adresses->street=$this->registration->ulitsa;
            $adresses->house=$this->registration->dom;
            $adresses->room=$this->registration->kvartera;
            $adresses->orientir=$this->registration->orenter;
            $adresses->save(false);

            if(!empty($this->registration->desc_comment)){
                $CommentProfile=new CommentProfile();
                $CommentProfile->com_text =$this->registration->desc_comment;
                $CommentProfile->sts=10;
                $CommentProfile->profile_id=$model->user_id;
                $CommentProfile->save(false);
            }


            $auth=Yii::$app->authManager;
            $rol=$auth->getRole("client_juridical");
            $auth->assign($rol, $user_model->id);

            $this->sendMail($user_model->username, $user_model->auth_key, $model->lastname, $model->firstname, $this->registration->email);

            $transaction->commit();
            return $user_model->user_id;
        }catch(Exceptin $e){
            $transaction->rollback();
            return false;
        }
        return false;
    }
    //fizicheskiy litsoni ruyxatdan o'tkazish
    /**
     * @return bool|string
     */
    public function RegistrationUser(){
        $connection= \Yii::$app->db;
        $transaction=$connection->beginTransaction();
        $user_model=new User();
        $model = new Profile();
        try{
            $user_model->email=$this->registration->email;
            $user_model->telefon=$this->registration->telefon;
            $user_model->status=0;
            $user_model->save(false);

            $model->created_by=Yii::$app->user->getId();
            $user_model->username="UZB".$user_model->id;
            $user_model->user_id="UZB".$user_model->id;
            $user_model->auth_key = \Yii::$app->security->generateRandomString();
            $user_model->save(false);


            $model->user_id=$user_model->id;
            $model->firstname=$this->registration->ism;
            $model->lastname=$this->registration->familiya;
            $model->fathername=$this->registration->otasiningismi;
            $model->tell=$this->registration->telefon;
            $model->role="client";
            $model->is_juridical=10;
            $model->status=0;
            $model->region_id=$this->registration->oblast;
            $model->email=$this->registration->email;
            $model->save(false);



            $adresses=new Adresses();

            $adresses->strana_id=$this->registration->strana;
            $adresses->profile_id=$model->user_id;
            $adresses->oblast_id=$this->registration->oblast;
            $adresses->city_id=$this->registration->gorod;
            $adresses->pochta_index=$this->registration->index;
            $adresses->street=$this->registration->ulitsa;
            $adresses->house=$this->registration->dom;
            $adresses->room=$this->registration->kvartera;
            $adresses->orientir=$this->registration->orenter;
            $adresses->save(false);

            if(!empty($this->registration->desc_comment)){
                $CommentProfile=new CommentProfile();
                $CommentProfile->com_text =$this->registration->desc_comment;
                $CommentProfile->sts=10;
                $CommentProfile->profile_id=$model->user_id;
                $CommentProfile->save(false);
            }


            $auth=Yii::$app->authManager;
            $rol=$auth->getRole("client");
            $auth->assign($rol, $user_model->id);
            $this->sendMail($user_model->username, $user_model->auth_key, $model->lastname, $model->firstname, $this->registration->email);

            $transaction->commit();
            return $user_model->user_id;
        }catch(Exceptin $e){
            $transaction->rollback();
            return false;
        }
        return false;
    }
    //emailga xabar junatish
    /**
     * @param $username
     * @param $auth_key
     * @param $familiya
     * @param $ism
     * @param $email
     */
    protected function sendMail($username, $auth_key, $familiya, $ism, $email){
        Yii::$app->mailer->compose('auth_user', [
            'user_name'=>$username,
            'auth_key'=>$auth_key,
            'familiya'=>$familiya,
            'ism'=>$ism,
        ])
            ->setFrom("registration@alior.uz")
            ->setTo($email)
            ->setSubject("Активация аккаунта")
            ->send();
    }

    //userni blockka solish
    /**
     * @param $profile_id
     * @return bool
     */
    public static function setBlock($profile_id){
        $user=\app\models\User::findOne($profile_id);
        $profile=\app\models\Profile::findOne($profile_id);
        if(empty($user))
        {
            return false;
        }

        if($user->status==\app\models\User::STATUS_BLOCKED)
        {
            return false;
        }
        $user->status=\app\models\User::STATUS_BLOCKED;
        $profile->status=\app\models\User::STATUS_BLOCKED;
        if($user->save(false) && $profile->save(false))
        {
            return true;
        }else{
            return false;
        }
    }

    //userni DELETED status berish solish
    /**
     * @param $profile_id
     * @return bool
     */
    public static function setDeleted($profile_id){
        $user=\app\models\User::findOne($profile_id);
        $profile=\app\models\Profile::findOne($profile_id);
        if(empty($user))
        {
            return false;
        }

        if($user->status==\app\models\User::STATUS_DELETED)
        {
            return false;
        }
        $user->status=\app\models\User::STATUS_DELETED;
        $profile->status=\app\models\User::STATUS_DELETED;
        if($user->save(false) && $profile->save(false))
        {
            return true;
        }else{
            return false;
        }
    }

    /**
     * @param $profile_id
     * @return bool
     */
    public static function unBlock($profile_id){

        if(!\app\models\config\Ruxsatnoma::Admin(Profile::findOne($profile_id))){
            return false;
        }
        $user=\app\models\User::findOne($profile_id);
        $profile=\app\models\Profile::findOne($profile_id);
        if(empty($user))
        {
            return false;
        }

        if($user->status==\app\models\User::STATUS_CHECKED)
        {
            return false;
        }
        $user->status=\app\models\User::STATUS_CHECKED;
        $profile->status=\app\models\User::STATUS_CHECKED;
        if($user->save(false) && $profile->save(false))
        {
            return true;
        }else{
            return false;
        }
    }


    /**
     * userni blokda yoki blokda emasligini tekshirish
     * 1. holat oformit zakazni bosganda
     * 2. Saytga kirganda
     * 3. Adminkaga kirganda holatini tekshirsh
     * 4. istalgan joyda
     * @return bool
     */
    public static function isBlack($user_id=null){
        if(!Yii::$app->user->isGuest) {
            $ids_admin_region = \app\models\Profile::getIds('admin', Yii::$app->user->identity->getRegionId());
            $is_admin_block = \app\models\Profile::find()->where(['user_id' => $ids_admin_region, 'status' => \app\models\User::STATUS_BLOCKED])->all();
            if (count($is_admin_block) > 0) {
                return false;
            }
            if (!empty($user_id)) {
                $mod = \app\models\Profile::find()->where(['user_id' => $user_id])->asArray()->one();
                return $mod['status'] == \app\models\User::STATUS_BLOCKED ? true : false;
            }
            return Yii::$app->user->identity->status == \app\models\User::STATUS_BLOCKED ? true : false;
        }
        return false;
    }

    //Satrudniklarni uchirish uchun
    public static function userDelete($model)
    {
        $connection = Yii::$app->db;
        $user=new \app\models\User();
        $transaction = $connection->beginTransaction();
        try {
            $us=$user->findOne($model->user_id);
            $manager = Yii::$app->authManager;
            $item = $manager->getRole($model->role);
            $manager->revoke( $item, $model->user_id );
            $us->delete();
            //$Employee->delete();
            $transaction->commit();
            return true;
        }catch(Exception $e)
        {
            $transaction->rollBack();
            return false;
        }

    }



}