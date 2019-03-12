<?php

use yii\db\Migration;
use yii\db\Schema;
/**
 * Class m180419_091105_create_table_attribute
 */
class m180419_091105_create_table_attribute extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product_attr}}', [
            'id'=>Schema::TYPE_PK."",
            'product_id'=>Schema::TYPE_INTEGER."(11)",
            'attr_name_id'=>Schema::TYPE_STRING."(255)",
            'attr_name'=>Schema::TYPE_STRING."(255)",
            'attr_value'=>Schema::TYPE_STRING."(255)",
            'is_group'=>Schema::TYPE_SMALLINT.""
        ]);


        $this->addForeignKey(
            "fk-product_attr-id",
            "product_attr",
            "product_id",
            "product",
            "id",
            "CASCADE"
        );


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product_attr}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180419_091105_create_table_attribute cannot be reverted.\n";

        return false;
    }
    */
}
