<?php

use yii\db\Migration;

/**
 * Class m180719_060838_fk_market_id
 */
class m180719_060838_fk_market_id extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-market-id',
            'profile',
            'market_id',
            'marketplace',
            'id',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180719_060838_fk_market_id cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180719_060838_fk_market_id cannot be reverted.\n";

        return false;
    }
    */
}
