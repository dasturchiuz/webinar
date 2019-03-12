<?php

use yii\db\Migration;

/**
 * Class m180420_082804_add_columnattr_isfilter
 */
class m180420_082804_add_columnattr_isfilter extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('product_attr', 'is_filter', 'TINYINT NOT NULL AFTER `is_group`');
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
        echo "m180420_082804_add_columnattr_isfilter cannot be reverted.\n";

        return false;
    }
    */
}
