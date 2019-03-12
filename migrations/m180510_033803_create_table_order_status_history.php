<?php

use yii\db\Migration;

/**
 * Class m180510_033803_create_table_order_status_history
 */
class m180510_033803_create_table_order_status_history extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order_status_history}}', [
            'id' => $this->primaryKey(),
            'status' => $this->tinyInteger(),
            'order_id' => $this->integer()->notNull(),
            'notfy_client' => $this->tinyInteger(),
            'comment_status' => $this->string(300),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull(),
        ]);

        $this->addForeginKey(
            'fk-orderhistory-id',
            '{{%order_status_history}}',
            'order_id',
            '{{%orders}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-orderhistory-created_by',
            '{{%order_status_history}}',
            'created_by',
            '{{%profile}}',
            'user_id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%order_status_history}}');
        $this->dropIndex(
            'fk-orderhistory-created_by',
            '{{%order_status_history}}'
        );
        $this->dropIndex(
            'fk-orderhistory-id',
            '{{%order_status_history}}'
        );

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180510_033803_create_table_order_status_history cannot be reverted.\n";

        return false;
    }
    */
}
