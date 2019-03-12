<?php

use yii\db\Migration;

/**
 * Class m180423_130912_add_column_to_orders_status
 */
class m180423_130912_add_column_to_orders_status extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%orders}}', 'status', $this->tinyInteger()->after('note'));
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
        echo "m180423_130912_add_column_to_orders_status cannot be reverted.\n";

        return false;
    }
    */
}
