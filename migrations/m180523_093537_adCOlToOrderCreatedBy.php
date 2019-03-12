<?php

use yii\db\Migration;

/**
 * Class m180523_093537_adCOlToOrderCreatedBy
 */
class m180523_093537_adCOlToOrderCreatedBy extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%orders}}', 'created_by', $this->integer()->after('courier_id'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180523_093537_adCOlToOrderCreatedBy cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180523_093537_adCOlToOrderCreatedBy cannot be reverted.\n";

        return false;
    }
    */
}
