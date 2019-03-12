<?php

use yii\db\Migration;

/**
 * Handles the creation of table `order_item`.
 */
class m180422_160453_create_order_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('order_item', [
            'id' => $this->primaryKey(),
            'order_id'=>$this->integer()->notNull(),
            'product_id'=>$this->integer()->notNull(),
            'name'=>$this->string(255),
            'price'=>$this->float(),
            'qty_item'=>$this->integer(),
            'summ_item'=>$this->float(),
        ]);



    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('order_item');
    }
}
