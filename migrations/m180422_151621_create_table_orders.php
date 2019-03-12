<?php

use yii\db\Migration;
use yii\db\Schema;
/**
 * Class m180422_151621_create_table_orders
 */
class m180422_151621_create_table_orders extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%orders}}', [
            'id'=>Schema::TYPE_PK."",
            'created_at'=>Schema::TYPE_DATETIME,
            'updated_at'=>Schema::TYPE_DATETIME,
            'qty'=>Schema::TYPE_INTEGER."(11)",
            'sum'=>Schema::TYPE_FLOAT."(11)",
            'user_id'=>Schema::TYPE_INTEGER ."(11)",
            'region_id'=>Schema::TYPE_INTEGER ."(11)",
            'adress'=>Schema::TYPE_TEXT ."",
            'phone'=>Schema::TYPE_STRING ."(20)",
            'email'=>Schema::TYPE_TEXT ."(155)",
        ]);

        $this->addForeignKey(
            'fk_user_id',
            '{{%orders}}',
            'user_id',
            '{{%profile}}',
            'user_id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-region-id',
            '{{%orders}}',
            'region_id',
            '{{%regions}}',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%orders}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180422_151621_create_table_orders cannot be reverted.\n";

        return false;
    }
    */
}
