<?php

use yii\db\Migration;

/**
 * Handles the creation of table `news`.
 */
class m180512_113746_create_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('news', [
            'id' => $this->primaryKey(),
            'slug'=>$this->string(255)->notNull(),
            'title'=>$this->text(),
            'meta_keywords'=>$this->text(),
            'meta_description'=>$this->text(),
            'content'=>$this->text(),
            'status'=>$this->tinyInteger()->defaultValue(10),
            'category_id'=>$this->integer(),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer(),
            'created_by'=>$this->integer()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('news');
    }
}
