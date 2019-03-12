<?php

use yii\db\Migration;

/**
 * Class m180521_090315_add_col_discount
 */
class m180521_090315_add_col_discount extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%discount}}', 'discount_name', $this->integer()->after('product_id'));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%discount}}', 'discount_name');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180521_090315_add_col_discount cannot be reverted.\n";

        return false;
    }
    */
}
