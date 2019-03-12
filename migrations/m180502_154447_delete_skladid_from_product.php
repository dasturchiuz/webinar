<?php

use yii\db\Migration;

/**
 * Class m180502_154447_delete_skladid_from_product
 */
class m180502_154447_delete_skladid_from_product extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropIndex(
            'sklad_idindx',
            '{{%product}}'
        );
        $this->dropColumn('{{%product}}', 'sklad_id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('{{%product}}', 'sklad_id', $this->integer()->notNull()->after('slug'));
        $this->createIndex('sklad_idindx', '{{%product}}', 'sklad_id');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180502_154447_delete_skladid_from_product cannot be reverted.\n";

        return false;
    }
    */
}
