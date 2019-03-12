<?php

use yii\db\Migration;

/**
 * Handles the creation of table `newscategory`.
 */
class m180512_113818_create_newscategory_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('newscategory', [
            'id' => $this->primaryKey(),
            'category_name'=>$this->string()

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('newscategory');
    }
}
