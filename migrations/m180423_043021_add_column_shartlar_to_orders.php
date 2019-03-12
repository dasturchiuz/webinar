<?php

use yii\db\Migration;

/**
 * Class m180423_043021_add_column_shartlar_to_orders
 */
class m180423_043021_add_column_shartlar_to_orders extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%orders}}', 'termsofuse', $this->tinyInteger()->after('note'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
      $this->dropColumn('{{%orders}}', 'termsofuse');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180423_043021_add_column_shartlar_to_orders cannot be reverted.\n";

        return false;
    }
    */
}
