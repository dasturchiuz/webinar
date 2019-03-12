<?php

use yii\db\Migration;

/**
 * Class m180502_160044_add_product_column_created_updated
 */
class m180502_160044_add_product_column_created_updated extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%product}}', 'created_at', $this->integer()->notNull()->after('user_id'));
        $this->addColumn('{{%product}}', 'updated_at', $this->integer()->notNull()->after('user_id'));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%product}}', 'created_at');
        $this->dropColumn('{{%product}}', 'updated_at');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180502_160044_add_product_column_created_updated cannot be reverted.\n";

        return false;
    }
    */
}
