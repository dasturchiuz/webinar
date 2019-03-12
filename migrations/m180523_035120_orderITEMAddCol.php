<?php

use yii\db\Migration;

/**
 * Class m180523_035120_orderITEMAddCol
 */
class m180523_035120_orderITEMAddCol extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%order_item}}', 'discount_procent', $this->integer()->after('summ_item'));
        $this->addColumn('{{%order_item}}', 'discount_name', $this->string()->append('CHARACTER SET utf8 COLLATE utf8_general_ci')->after('discount_procent'));
        $this->addColumn('{{%order_item}}', 'discount_id', $this->integer()->after('discount_name'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180523_035120_orderITEMAddCol cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180523_035120_orderITEMAddCol cannot be reverted.\n";

        return false;
    }
    */
}
