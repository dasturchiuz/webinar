<?php

use yii\db\Migration;

/**
 * Class m180521_082555_delViewCount
 */
class m180521_082555_delViewCount extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%product}}', 'view_count');
        $this->addColumn('{{%product}}', 'view_count', $this->integer()->defaultValue(1)->after('status'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180521_082555_delViewCount cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180521_082555_delViewCount cannot be reverted.\n";

        return false;
    }
    */
}
