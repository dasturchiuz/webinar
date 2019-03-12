<?php

use yii\db\Migration;

/**
 * Class m180429_150757_create_table_product_reviews
 */
class m180429_150757_create_table_product_reviews extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product_reviews}}', [
            'id'=>$this->primaryKey(),
            'user_id'=>$this->integer()->notNull(),
            'product_id'=>$this->integer()->notNull(),
            'star_rating'=>$this->tinyInteger()->notNull(),
            'otziv_text'=>$this->string(500)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product_reviews}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180429_150757_create_table_product_reviews cannot be reverted.\n";

        return false;
    }
    */
}
