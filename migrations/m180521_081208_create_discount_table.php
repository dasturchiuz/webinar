<?php

use yii\db\Migration;

/**
 * Handles the creation of table `discount`.
 */
class m180521_081208_create_discount_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('discount', [
            'id' => $this->primaryKey(),
            'product_id'=>$this->integer()->notNull(),
            'price_procent'=>$this->integer()->notNull(),
            'date_strat'=>$this->datetime()->notNull(),
            'date_int'=>$this->datetime()->notNull(),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer(),
            'created_by'=>$this->integer(),
        ]);


        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('discount');
    }
}
