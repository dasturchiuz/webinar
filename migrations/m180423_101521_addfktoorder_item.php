<?php

use yii\db\Migration;

/**
 * Class m180423_101521_addfktoorder_item
 */
class m180423_101521_addfktoorder_item extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
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
        echo "m180423_101521_addfktoorder_item cannot be reverted.\n";

        return false;
    }
    */
}
