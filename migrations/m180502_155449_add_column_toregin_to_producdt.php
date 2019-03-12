<?php

use yii\db\Migration;

/**
 * Class m180502_155449_add_column_toregin_to_producdt
 */
class m180502_155449_add_column_toregin_to_producdt extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180502_155449_add_column_toregin_to_producdt cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180502_155449_add_column_toregin_to_producdt cannot be reverted.\n";

        return false;
    }
    */
}
