<?php

use yii\db\Migration;

/**
 * Class m180522_124444_colnamechangeDISCOUNT
 */
class m180522_124444_colnamechangeDISCOUNT extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%discount}}', 'date_strat');
        $this->dropColumn('{{%discount}}', 'date_int');
        $this->addColumn('{{%discount}}', 'date_start', $this->datetime()->notNull()->after('price_procent'));
        $this->addColumn('{{%discount}}', 'date_end', $this->datetime()->notNull()->after('date_start'));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180522_124444_colnamechangeDISCOUNT cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180522_124444_colnamechangeDISCOUNT cannot be reverted.\n";

        return false;
    }
    */
}
