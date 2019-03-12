<?php

use yii\db\Migration;
use yii\db\Schema;
/**
 * Class m180418_094448_product_images_table
 */
class m180418_094448_product_images_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product_images}}', [
            'id'=>Schema::TYPE_PK."",
            'product_id'=>Schema::TYPE_INTEGER."(11)",
            'img_path'=>Schema::TYPE_TEXT."",
            'sort'=>Schema::TYPE_INTEGER."(1)",
        ]);


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product_images}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180418_094448_product_images_table cannot be reverted.\n";

        return false;
    }
    */
}
