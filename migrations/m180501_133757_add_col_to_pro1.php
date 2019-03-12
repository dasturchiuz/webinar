<?php

use yii\db\Migration;

/**
 * Class m180501_133757_add_col_to_pro1
 */
class m180501_133757_add_col_to_pro1 extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%product}}', 'status', $this->tinyInteger()->after('slug'));
        $this->addColumn('{{%product}}', 'user_id', $this->integer()->notNull()->after('slug'));
        $this->addColumn('{{%product}}', 'sklad_id', $this->integer()->notNull()->after('slug'));
        $this->addColumn('{{%product}}', 'aproval_id', $this->integer()->notNull()->after('slug'));
        $this->addColumn('{{%product}}', 'unit_id', $this->integer()->notNull()->after('slug'));

        $this->createIndex('unit_idindx', '{{%product}}', 'unit_id');
        $this->createIndex('sklad_idindx', '{{%product}}', 'sklad_id');
        $this->createIndex('aproval_idindx', '{{%product}}', 'aproval_id');
        $this->createIndex('user_idindx', '{{%product}}', 'user_id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%product}}', 'status');
        $this->dropColumn('{{%product}}', 'user_id');
        $this->dropColumn('{{%product}}', 'sklad_id');
        $this->dropColumn('{{%product}}', 'aproval_id');
        $this->dropColumn('{{%product}}', 'unit_id');
        $this->dropIndex(
            'unit_idindx',
            '{{%product}}'
        );
        $this->dropIndex(
            'sklad_idindx',
            '{{%product}}'
        );
        $this->dropIndex(
            'aproval_idindx',
            '{{%product}}'
        );
        $this->dropIndex(
            'user_idindx',
            '{{%product}}'
        );

    }


    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180501_133757_add_col_to_pro1 cannot be reverted.\n";

        return false;
    }
    */
}
