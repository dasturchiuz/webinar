<?php

use yii\db\Migration;

/**
 * Handles the creation of table `strana`.
 */
class m180603_115453_create_strana_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('strana', [
            'id' => $this->primaryKey(),
            'strana_name'=>$this->string(100),
            'sort_strana'=>$this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('strana');
    }
}
