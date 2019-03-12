<?php

use yii\db\Migration;

/**
 * Class m180503_122432_add_col_to_orders_kuryer_id
 */
class m180503_122432_add_col_to_orders_kuryer_id extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%orders}}', 'courier_id', $this->integer()->after('termsofuse'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%orders}}', 'courier_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180503_122432_add_col_to_orders_kuryer_id cannot be reverted.\n";

        return false;
    }
    */
}
