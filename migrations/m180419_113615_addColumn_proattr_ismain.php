<?php

use yii\db\Migration;

/**
 * Class m180419_113615_addColumn_proattr_ismain
 */
class m180419_113615_addColumn_proattr_ismain extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('product_attr', 'is_main', 'TINYINT NOT NULL AFTER `is_filter`');
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
        echo "m180419_113615_addColumn_proattr_ismain cannot be reverted.\n";

        return false;
    }
    */
}
