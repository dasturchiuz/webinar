<?php

use yii\db\Migration;

/**
 * Class m180423_023606_create_table_pay_method
 */
class m180423_023606_create_table_pay_method extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%pay_method}}', [
            'id'=>$this->primaryKey(),
            'pay_name'=>$this->string(50)->notNull(),
            'payment_status'=>$this->tinyInteger()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%pay_method}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180423_023606_create_table_pay_method cannot be reverted.\n";

        return false;
    }
    */
}
