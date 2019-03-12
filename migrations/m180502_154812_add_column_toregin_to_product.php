<?php

use yii\db\Migration;

/**
 * Class m180502_154812_add_column_toregin_to_product
 */
class m180502_154812_add_column_toregin_to_product extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%product}}', 'region_id', $this->integer()->notNull()->after('slug'));
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%product}}', 'region_id');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180502_154812_add_column_toregin_to_product cannot be reverted.\n";

        return false;
    }
    */
}
