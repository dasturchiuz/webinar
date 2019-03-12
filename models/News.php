<?php

namespace app\models;

use Yii;

use yii\behaviors\AttributeBehavior;
use yii\behaviors\TimestampBehavior;
//use yii\behaviors\SluggableBehavior;
use zabachok\behaviors\SluggableBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%news}}".
 *
 * @property int $id
 * @property string $slug
 * @property string $title
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $content
 * @property int $status
 * @property int $category_id
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 */
class News extends \yii\db\ActiveRecord
{
    const STATUS_OK=10;
    const STATUS_CONCEL=0;
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
                    ActiveRecord::EVENT_BEFORE_INSERT=>['created_by'],
                ],
                'value' => function ($event) {
                    return Yii::$app->user->getId();
                },
            ],
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
                // 'slugAttribute' => 'slug',
                'immutable' => true,
                'ensureUnique'=>true,
            ],


        ];
    }

    public static function getStatuses(){
        return [
            self::STATUS_OK=>"Опубликован",
            self::STATUS_CONCEL => "Не опубликован",
        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%news}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
//            [['slug', 'created_by'], 'safe'],
            [['title', 'content', 'status', 'slug'], 'required'],
            [['title', 'meta_keywords', 'meta_description', 'content'], 'string'],
            [['status', 'category_id', 'created_at', 'updated_at', 'created_by', 'in_menu', 'sort'], 'integer'],
            [['slug'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'slug' => Yii::t('app', 'Slug'),
            'title' => Yii::t('app', 'Заголовка'),
            'meta_keywords' => Yii::t('app', 'Ключевые слова'),
            'meta_description' => Yii::t('app', 'Описание'),
            'content' => Yii::t('app', 'Content'),
            'status' => Yii::t('app', 'Статус'),
            'category_id' => Yii::t('app', 'Категории'),
            'created_at' => Yii::t('app', 'Создан в'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Создано'),
            'in_menu' => Yii::t('app', 'Основная меню'),
            'sort' => Yii::t('app', 'Сорт'),
        ];
    }

    public function getCategory(){
        return $this->hasOne(Newscategory::className(), ['id'=>'category_id']);
    }

    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['user_id'=>'created_by']);
    }


}
