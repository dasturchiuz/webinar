<?php

use yii\db\Migration;

/**
 * Class m180520_135357_addpro_views_count
 */
class m180520_135357_addpro_views_count extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%product}}', 'view_count', $this->integer()->after('status'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%product}}', 'view_count');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180520_135357_addpro_views_count cannot be reverted.\n";

        return false;
    }
    */
}
