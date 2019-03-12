<?php

use yii\db\Migration;

/**
 * Class m180423_022634_add_column_orders
 */
class m180423_022634_add_column_orders extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('orders', 'note', $this->text()->after('email'));
        $this->addColumn('orders', 'pay_method_id', $this->integer()->after('email'));
        $this->addColumn('orders', 'pay_method_name', $this->string(50)->after('email'));
        $this->addColumn('orders', 'pay_status', $this->tinyInteger()->after('email'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('orders', 'note');
        $this->dropColumn('orders', 'pay_method_id');
        $this->dropColumn('orders', 'pay_method_name');
        $this->dropColumn('orders', 'pay_status');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180423_022634_add_column_orders cannot be reverted.\n";

        return false;
    }
    */
}
