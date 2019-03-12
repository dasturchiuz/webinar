<?php

use yii\db\Migration;

/**
 * Class m180430_095350_add_column_to_reviews
 */
class m180430_095350_add_column_to_reviews extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%product_reviews}}', 'status', $this->tinyInteger()->after('otziv_text'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%product_reviews}}', 'status');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180430_095350_add_column_to_reviews cannot be reverted.\n";

        return false;
    }
    */
}
