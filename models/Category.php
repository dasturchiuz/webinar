<?php

namespace app\models;

use Yii;
<<<<<<< HEAD

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $title
 */
class Category extends \yii\db\ActiveRecord
{
=======
use zabachok\behaviors\SluggableBehavior;

/**
 * This is the model class for table "{{%category}}".
 *
 * @property int $id
 * @property int $parent_id
 * @property string $name
 * @property string $code
 * @property string $slug
 * @property string $text
 * @property string $image
 * @property int $sort
 */
class Category extends \yii\db\ActiveRecord
{
    public function behaviors(){
        return [

            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'name',
                // 'slugAttribute' => 'slug',
                'immutable' => true,
                'ensureUnique'=>true,
            ],
        ];
    }
>>>>>>> origin/master
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
<<<<<<< HEAD
        return 'category';
=======
        return '{{%category}}';
>>>>>>> origin/master
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
<<<<<<< HEAD
            [['title'], 'string', 'max' => 255],
=======
            [['parent_id', 'sort'], 'integer'],
            [['name'], 'required'],
            [['text', 'image'], 'string'],
            [['name'], 'string', 'max' => 50],
            [['code'], 'string', 'max' => 155],
            [['slug'], 'string', 'max' => 255],
>>>>>>> origin/master
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
<<<<<<< HEAD
            'id' => 'ID',
            'title' => 'Title',
        ];
    }

    public function getArticles()
    {
        return $this->hasMany(Aticle::classname(), ['category_id' => 'id']);
    }
=======
            'id' => Yii::t('app', 'ID'),
            'parent_id' => Yii::t('app', 'Родительская категория'),
            'name' => Yii::t('app', 'название категории'),
            'code' => Yii::t('app', 'Код'),
            'slug' => Yii::t('app', 'Slug'),
            'text' => Yii::t('app', 'Описание'),
            'image' => Yii::t('app', 'Изобрражения'),
            'sort' => Yii::t('app', 'Сорт номер '),
        ];
    }

    public function getParentt(){
        return \app\models\Category::findOne($this->parent_id);
    }

    public function getCatname(){
        $data=$this->parent;
        return $data->code;
    }


//    public static function getItems($intent='', $parent_id=null){
//        $items=[];
//        $parents=self::find()->where(['parent_id'=>$parent_id])->all();
//        foreach($parents as $par){
//            $items[$par->id]=$intent.$par->name;
//            $items=array_merge($items, self::getItems($intent.' ', $par->id));
//        }
//        return $items;
//    }
    public static function getIdBySlug($slug){
        $cat=Category::find()->where(['slug'=>$slug])->one();
        if($cat!=null)
            return $cat->id;
        else
            return false;
    }
    public static function getCategories($parent = null, $spacing='', $tree_array='')
    {
        if(!is_array($tree_array))
            $tree_array=array();

            $model=Category::find()->where(['parent_id'=>$parent])->orderby('id ASC')->all();
            if(count($model)>0){
                foreach($model as $itm){
                    $tree_array[] = array('id'=>$itm->id, 'name'=>$spacing.$itm->name);
                    $tree_array=self::getCategories($itm->id, $spacing.'-', $tree_array);
                }
            }
        return $tree_array;

    }

    public static function  getCat($id=null, $tree_array=null){
        if(!is_array($tree_array)){
            $tree_array=array();
        }

        $model=Category::find()->where(['id'=>$id])->asArray()->one();
        if(!empty($model)){
            $tree_array[]=$model;
            $tree_array = self::getCat($model["parent_id"], $tree_array);
        }

        return $tree_array;

    }

    public function getUsercategory($user_id){
        $categor=[];
        foreach(\app\models\Product::find()->select('category_id')->where(['user_id'=>$user_id])->groupby('category_id')->all() as $item){
            $categor[]=$this->getCat($item->category_id);
        }
        return $categor;
    }

    public static function getCategoryids($parent = null, $tree_array='')
    {
        if(!is_array($tree_array))
            $tree_array=array();
            $tree_array[]=$parent;
            $model=Category::find()->where(['parent_id'=>$parent])->orderby('id ASC')->all();
            if(count($model)>0){
                foreach($model as $itm){
                    $tree_array=self::getCategoryids($itm->id,  $tree_array);
                }
            }
        return $tree_array;

    }

    public static function buildTree($parent_id = null)
    {
        $return = [];

        if(empty($parent_id)) {
            $categories = Category::find()->where('parent_id = 0 OR parent_id is null')->orderBy('sort DESC')->asArray()->all();
        } else {
            $categories = Category::find()->where(['parent_id' => $parent_id])->orderBy('sort DESC')->asArray()->all();
        }

        foreach($categories as $level1) {
            $return[$level1['id']] = $level1;
            $return[$level1['id']]['childs'] = self::buildTree($level1['id']);
        }

        return $return;
    }

    public static function buildTreeUserId($user_id)
    {
        $query = new  \yii\db\Query;
        $query	->select([
                'category.name',
                'category.slug',]
        )
            ->from('category')
            ->join('LEFT JOIN', 'product',
                'product.category_id =category.id')
            ->where(['product.user_id'=>$user_id])
            ->groupby('product.category_id');
        $command = $query->createCommand();
        $data = $command->queryAll();
        return $data;
    }


    // public function parentCategoriesList(): array
    // {
        // return ArrayHelper::map(Category::find()->orderBy('lft')->asArray()->all(), 'id', function (array $category) {
            // return ($category['depth'] > 1 ? str_repeat('-- ', $category['depth'] - 1) . ' ' : '') . $category['name'];
        // });
    // }

>>>>>>> origin/master
}
