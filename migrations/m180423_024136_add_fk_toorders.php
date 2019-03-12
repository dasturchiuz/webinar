<?php

use yii\db\Migration;

/**
 * Class m180423_024136_add_fk_toorders
 */
class m180423_024136_add_fk_toorders extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        //$this->createIndex('pay_method_id', '{{%orders}}', 'pay_method_id', 0);
        $this->addForeignKey(
            "fk-orders-id",
            "order_item",
            "order_id",
            "orders",
            "id",
            "CASCADE"
        );

        $this->addForeignKey(
            "fk-productw-id",
            "order_item",
            "product_id",
            "product",
            "id",
            "CASCADE"
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180423_024136_add_fk_toorders cannot be reverted.\n";

        return false;
    }
    */
}
