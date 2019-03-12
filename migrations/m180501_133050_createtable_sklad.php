<?php

use yii\db\Migration;

/**
 * Class m180501_133050_createtable_sklad
 */
class m180501_133050_createtable_sklad extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%sklad}}', [
            'id'=>$this->primaryKey(),
            'sklad_name'=>$this->string(30)->notNull(),
            'sklad_region'=>$this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%sklad}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180501_133050_createtable_sklad cannot be reverted.\n";

        return false;
    }
    */
}
