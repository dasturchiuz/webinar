<?php
namespace app\models\courieractions;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Profile;
use app\models\Orders;
class SearchModel  extends Orders{

    public function rules()
    {
        return [
            [['id', 'qty', 'user_id', 'region_id', 'pay_status', 'pay_method_id', 'status', 'created_by'], 'integer'],
            [['created_at', 'updated_at', 'firstname', 'lastname', 'adress', 'phone', 'email', 'pay_method_name', 'note'], 'safe'],
            [['sum'], 'number'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * SELECT * FROM orders o LEFT JOIN profile p ON o.user_id=p.user_id LEFT JOIN weeks_client_list w ON w.client_id=o.user_id
     * WHERE delivery_date=CURDATE() and p.region_id=11 GROUP BY o.id
     * @param $region_id
     * @param $date
     * @return ActiveDataProvider
     */

    //Region buyicha bugungi zakazlarni chiqaradi
    public function search($region_id, $date)
    {
        $query = Orders::find()
            ->alias('o')
            ->joinWith([
                'profile' => function($q) {
                    $q->alias('p');
                }
            ])
            ->joinWith([
                'week' => function($q) {
                    $q->alias('w');
                    $q->where(['w.role_type'=>\app\models\WeeksClientList::ROLE_COURER]);

                }
            ])
            ->where(['o.delivery_date'=>$date, 'p.region_id'=>$region_id])
            ->groupby('o.delivery_date')
        ;

//        $query = Profile::find()
//            ->alias('p')
//            ->joinWith([
//                'orders' => function($q) use($date){
//                    $q->alias('o');
////                    $q->select('MAX(FROM_UNIXTIME(o.created_at)) as order_date');
//                    $q->where([ 'o.delivery_date'=>$date]);
////                    $q->groupby('o.user_id');
////                    $q->orderBy(['MAX(FROM_UNIXTIME(o.created_at))'=>SORT_DESC]);
//                }
//            ])
//            ->joinWith([
//                'weeks' => function($q){
//                    $q->alias('w');
//                    $q->where(['w.role_type'=>\app\models\WeeksClientList::ROLE_COURER]);
//                }
//            ])
//            //->select("p.*, MAX(FROM_UNIXTIME(o.created_at)) as order_date") //oxirgi zakazni order_date deb olib uni profileda order_date o'zgaruvchisiga set qildim
//            ->where(['p.region_id'=>$region_id, 'p.role'=>'agent']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        return $dataProvider;
    }
    //Region buyicha bugungi zakazlarni chiqaradi
    public function searchSuperAdmin($date)
    {
        $query = Orders::find()
            ->alias('o')
            ->joinWith([
                'profile' => function($q) {
                    $q->alias('p');
                }
            ])
            ->joinWith([
                'week' => function($q) {
                    $q->alias('w');
                    $q->where(['w.role_type'=>\app\models\WeeksClientList::ROLE_COURER]);

                }
            ])
            ->where(['o.delivery_date'=>$date])
            ->groupby('p.user_id');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        return $dataProvider;
    }

    //Region buyicha bugungi zakazlarni chiqaradi
    public function searchProfileOrders($profile_id, $date)
    {
        $query = Orders::find()
            ->alias('o')
            ->joinWith([
                'profile' => function($q) {
                    $q->alias('p');
                }
            ])
            ->joinWith([
                'week' => function($q){
                    $q->alias('w');


                }
            ])
            ->where("`o`.`delivery_date`='$date' and`o`.`status`=10 and `w`.`user_id`=$profile_id  and `o`.`user_id`=`w`.`client_id`")
            ;

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        return $dataProvider;
    }

    //region buyicha za

    //vozvrot tavar bo'lgan usrerlarni region buyicha olish

    public function seachReturnProfiles($region_id){
        $query=\app\models\courieractions\CourierLoadedProducts::find()
            ->alias('c')
            ->joinWith([
                'profile'=>function($q){
                    $q->alias('p');
                }
            ])
            ->where(["p.region_id"=>$region_id])
            ->groupBy("c.courier_id");
        $dataProvider=new ActiveDataProvider([
            'query'=>$query,
            'pagination'=>[
                'pageSize'=>10,
            ],
        ]);

        return $dataProvider;
    }

    public function seachReturnProfilesSuperAdmin(){
        $query=\app\models\courieractions\CourierLoadedProducts::find()
            ->alias('c')
            ->joinWith([
                'profile'=>function($q){
                    $q->alias('p');
                }
            ])
            ->groupBy("c.courier_id");
        $dataProvider=new ActiveDataProvider([
            'query'=>$query,
            'pagination'=>[
                'pageSize'=>10,
            ],
        ]);

        return $dataProvider;
    }
}