<?php

use yii\db\Migration;

/**
 * Class m180512_020611_create_table_article
 */
class m180512_020611_create_table_article extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%article}}', [
            'id'=>$this->primaryKey(),
            'slug'=>$this->string(255)->notNull(),
            'title'=>$this->text(),
            'meta_keywords'=>$this->text(),
            'meta_description'=>$this->text(),
            'content'=>$this->text(),
            'status'=>$this->tinyInteger()->defaultValue(10),
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
        $this->dropTable('{{%article}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180512_020611_create_table_article cannot be reverted.\n";

        return false;
    }
    */
}
