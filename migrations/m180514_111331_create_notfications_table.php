<?php

use yii\db\Migration;

/**
 * Handles the creation of table `notfications`.
 */
class m180514_111331_create_notfications_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%notfications}}', [
            'id' => $this->primaryKey(),
            'notfy_type_id' => $this->integer(),
            'profile_id' => $this->integer(),
            'is_read' => $this->boolean(),
            'notfy_text' => $this->text(),
            'created_at' => $this->integer(),
            'receive_at' => $this->integer(),
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('notfications');
    }
}
