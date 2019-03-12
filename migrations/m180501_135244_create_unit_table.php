<?php

use yii\db\Migration;

/**
 * Handles the creation of table `unit`.
 */
class m180501_135244_create_unit_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('unit', [
            'id' => $this->primaryKey(),
            'unit_name' => $this->string(20)->notNull(),
            'status' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'unit_desc' => $this->string(100),
            'updated_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('unit');
    }
}
