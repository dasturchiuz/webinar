<?php

use yii\db\Migration;
use yii\db\Schema;
/**
 * Class m180411_112555_coategory
 */
class m180411_112555_coategory extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%category}}', [
            'id' => Schema::TYPE_PK . "",
            'parent_id' => Schema::TYPE_INTEGER . "(11)",
            'name' => Schema::TYPE_STRING . "(50) NOT NULL",
            'code' => Schema::TYPE_STRING . "(155)",
            'slug' => Schema::TYPE_STRING . "(255)",
            'text' => Schema::TYPE_TEXT . "",
            'image' => Schema::TYPE_TEXT . "",
            'sort' => Schema::TYPE_INTEGER . "(11)",
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%category}}');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180411_112555_coategory cannot be reverted.\n";

        return false;
    }
    */
}
