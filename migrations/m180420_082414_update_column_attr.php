<?php

use yii\db\Migration;

/**
 * Class m180420_082414_update_column_attr
 */
class m180420_082414_update_column_attr extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('product_attr', 'is_filter');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('product_attr', 'is_filter', 'TINYINT NOT NULL AFTER `is_group`');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180420_082414_update_column_attr cannot be reverted.\n";

        return false;
    }
    */
}
