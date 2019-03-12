<?php

use yii\db\Migration;

/**
 * Class m180423_040957_add_column_to_orders
 */
class m180423_040957_add_column_to_orders extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%orders}}', 'lastname', $this->string(20)->after('region_id'));
        $this->addColumn('{{%orders}}', 'firstname', $this->string(20)->after('region_id'));
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
        echo "m180423_040957_add_column_to_orders cannot be reverted.\n";

        return false;
    }
    */
}
