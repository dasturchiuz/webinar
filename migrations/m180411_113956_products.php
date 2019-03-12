<?php

use yii\db\Migration;
use yii\db\Schema;
/**
 * Class m180411_113956_products
 */
class m180411_113956_products extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product}}', [
            'id' => Schema::TYPE_PK . "",
            'category_id' => Schema::TYPE_INTEGER . "(10)",
            'profile_id' => Schema::TYPE_INTEGER . "(11)",
            'amount' => Schema::TYPE_INTEGER . "(11)",
            'related_products' => Schema::TYPE_TEXT . " COMMENT 'PHP serialize'",
            'name' => Schema::TYPE_STRING . "(200) NOT NULL",
            'code' => Schema::TYPE_STRING . "(155)",
            'price' => Schema::TYPE_DECIMAL . "(11, 2)",
            'price_protsent' => Schema::TYPE_INTEGER . "(11)",
            'text' => Schema::TYPE_TEXT . " ",
            'short_text' => Schema::TYPE_STRING . "(255)",
            'is_new' => "enum('yes','no')" . " DEFAULT 'no'",
            'is_popular' => "enum('yes','no')" . " DEFAULT 'no'",
            'feature_image' => Schema::TYPE_TEXT . "",
            'available' => "enum('yes','no')" . " DEFAULT 'yes'",
            'sort' => Schema::TYPE_INTEGER . "(11)",
            'slug' => Schema::TYPE_STRING . "(255)",
        ]);
        $this->createIndex('category_id', '{{%product}}', 'category_id', 0);
        $this->createIndex('profile_id', '{{%product}}', 'profile_id', 0);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180411_113956_products cannot be reverted.\n";

        return false;
    }
    */
}
