<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Profile;

/**
 * ProfileSearch represents the model behind the search form of `app\models\Profile`.
 */
class ProfileSearch extends Profile
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'is_juridical', 'status', 'created_at', 'updated_at', 'region_id'], 'integer'],
            [['firstname', 'lastname', 'fathername', 'tell', 'role', 'adress', 'login'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params, $filters=null, $data=[], $region_id=null)
    {

        $query = Profile::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>['defaultOrder'=>['created_at'=>SORT_DESC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        if(!empty($region_id)){
            $this->region_id=$region_id;
        }
        if(isset($filters) && !empty($filters)){
            switch($filters){
                case 'super_admin' :
                    $this->role=$filters;
                    break;
                case 'admin' :
                    $this->role=$filters;
                    break;
                case 'buxgalter' :
                    if( Yii::$app->user->can('admin'))
                    {
                        $this->region_id=Yii::$app->user->identity->getRegionId();
                    }
                    $this->role=$filters;
                    break;
                case 'manager' :

                    if( Yii::$app->user->can('admin'))
                    {
                        $this->region_id=Yii::$app->user->identity->getRegionId();
                    }

                    $this->role=$filters;
                    break;
                case 'regional_managers' :
                    if( Yii::$app->user->can('admin'))
                    {
                        $this->region_id=Yii::$app->user->identity->getRegionId();
                    }
                    $this->role=$filters;
                    break;
                case 'agent' :
                    if( Yii::$app->user->can('admin') || Yii::$app->user->can('regional_managers') || Yii::$app->user->can('manager'))
                    {
                        $this->region_id=Yii::$app->user->identity->getRegionId();
                    }
                    $this->role=$filters;
                    break;
                case 'client' :
                    if(\app\models\config\Ruxsatnoma::isHuquqRegion())
                    {
                        $this->region_id=Yii::$app->user->identity->getRegionId();
                    }
                    $this->role=$filters;
                    break;
                case 'client_juridical' :
                    if(\app\models\config\Ruxsatnoma::isHuquqRegion())
                    {
                        $this->region_id=Yii::$app->user->identity->getRegionId();
                    }

                    $this->role=$filters;
                    break;

                case 'сouriers' :
                    if( \app\models\config\Ruxsatnoma::isHuquqRegion())
                    {
                        $this->region_id=Yii::$app->user->identity->getRegionId();
                    }

                    $this->role=$filters;
                    break;



            }
        }
        // grid filtering conditions
        $query->andFilterWhere([
//            'user_id' => $this->user_id,
            'is_juridical' => $this->is_juridical,
            'status' => $this->status,
            'region_id' => $this->region_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'firstname', $this->firstname])
            ->andFilterWhere(['like', 'lastname', $this->lastname])
            ->andFilterWhere(['like', 'fathername', $this->fathername])
            ->andFilterWhere(['like', 'tell', $this->tell])
            ->andFilterWhere(['role' => $this->role])
            ->andFilterWhere(['like', 'adress', $this->adress]);
        $query->joinWith(['user'=>function($q){
            $q->where('user.username LIKE "%'.$this->login.'%"');
        }]);

        return $dataProvider;
    }
}
