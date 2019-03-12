<?php

namespace app\models;

use Yii;
use zabachok\behaviors\SluggableBehavior;


/**
 * This is the model class for table "{{%newscategory}}".
 *
 * @property int $id
 * @property string $category_name
 */
class Newscategory extends \yii\db\ActiveRecord
{
    public function behaviors(){
        return [

            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'category_name',
                // 'slugAttribute' => 'slug',
                'immutable' => true,
                'ensureUnique'=>true,
            ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%newscategory}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_name'], 'string', 'max' => 255],
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
            'category_name' => Yii::t('app', 'Название категории'),
        ];
    }
}
