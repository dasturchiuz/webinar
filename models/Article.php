<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property string $title
 * @property string $short_text
 * @property string $description
 * @property string $date
 * @property string $media
 * @property int $viewed
 * @property int $user_id
 * @property int $status
 * @property int $category_id
 *
 * @property ArticleTag[] $articleTags
 * @property Comment[] $comments
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'short_text', 'description'], 'required'],
            [['title', 'short_text', 'description',], 'string'],
            [['date'], 'date', 'format' => 'php:Y-m-d'],
            [['date'], 'default', 'value' => date('Y-m-d')],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'short_text' => 'Short Text',
            'description' => 'Description',
            'date' => 'Date',
            'media' => 'Media',
            'viewed' => 'Viewed',
            'user_id' => 'User ID',
            'status' => 'Status',
            'category_id' => 'Category ID',
        ];
    }

    public function saveMedia($filename)
    {
        $this->media = $filename;
        return $this->save(false);
    }

    public function getMedia()
    {
        return ($this->media) ? '/uploads/' . $this->media : '/no-media.png';
    }

    public function deleteMedia()
    {
        $mediaUploadModel = new MediaUpload();
        $mediaUploadModel->deleteCurrentMedia($this->media);
    }

    public function beforeDelete()
    {
        $this->deleteMedia();
        return parent::beforeDelete(); // TODO: Change the autogenerated stub
    }

    public function getCategory()
    {
        return $this->hasOne(Category::classname(), ['id' => 'category_id']);
    }

    public function saveCategory($category_id)
    {
        $category = Category::findOne($category_id);
        if($category != null)
        {
            $this->link('category', $category);
            return true;
        }
    }

    public function getTags()
    {
        return $this->hasMany(Tag::classname(), ['id' => 'tag_id'])
            ->viaTable('article_tag', ['article_id' => 'id']);
    }

    public function getSelectedTags()
    {
        $selectedTags = $this->getTags()->select('id')->asArray()->all();
    }

    public function saveArticle()
    {
        $this->user_id = Yii::$app->user->id;
        return $this->save();
    }


    public function viewedCounter()
    {
        $this->viewed += 1;
        return $this->save(false);
    }
}
