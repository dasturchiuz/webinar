<?php

use yii\db\Migration;

/**
 * Class m180508_033758_addtocolumnprofil
 */
class m180508_033758_addtocolumnprofil extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%profile}}', 'created_by', $this->integer()->after('updated_at'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%profile}}', 'created_by');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180508_033758_addtocolumnprofil cannot be reverted.\n";

        return false;
    }
    */
}
