<?php

use yii\db\Migration;

/**
 * Class m180419_105802_add_column_product_attr
 */
class m180419_105802_add_column_product_attr extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addColumn('product_attr', 'is_filter', $this->integer()->after('is_group'));
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
        echo "m180419_105802_add_column_product_attr cannot be reverted.\n";

        return false;
    }
    */
}
