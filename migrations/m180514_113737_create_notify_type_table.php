<?php

use yii\db\Migration;

/**
 * Handles the creation of table `notify_type`.
 */
class m180514_113737_create_notify_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('notify_type', [
            'id' => $this->primaryKey(),
            'notfy_name' => $this->string(),
            'notfy_template' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('notify_type');
    }
}
