<?php

use yii\db\Migration;
use yii\db\Schema;
/**
 * Class m180417_112609_manufacturer_table
 */
class m180417_112609_manufacturer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%manufacturer}}',[
            'id'=>Schema::TYPE_PK."",
            'name'=>Schema::TYPE_STRING."(255) NOT NULL",
            'code'=>Schema::TYPE_STRING."(155)",
            'desc'=>Schema::TYPE_TEXT."",
            'slug'=>Schema::TYPE_STRING."(255)",
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%manufacturer}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180417_112609_manufacturer_table cannot be reverted.\n";

        return false;
    }
    */
}
