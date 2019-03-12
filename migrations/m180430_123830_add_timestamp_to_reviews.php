<?php

use yii\db\Migration;

/**
 * Class m180430_123830_add_timestamp_to_reviews
 */
class m180430_123830_add_timestamp_to_reviews extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%product_reviews}}', 'updated_at', $this->Integer()->after('status'));
        $this->addColumn('{{%product_reviews}}', 'created_at', $this->Integer()->after('status'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180430_123830_add_timestamp_to_reviews cannot be reverted.\n";

        return false;
    }
    */
}
