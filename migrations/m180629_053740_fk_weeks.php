<?php

use yii\db\Migration;

/**
 * Class m180629_053740_fk_weeks
 */
class m180629_053740_fk_weeks extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-weeks-client_id',
            'weeks_client_list',
            'client_id',
            'user',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-weeks-user_id',
            'weeks_client_list',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-weeks-created_by',
            'weeks_client_list',
            'created_by',
            'user',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180629_053740_fk_weeks cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180629_053740_fk_weeks cannot be reverted.\n";

        return false;
    }
    */
}
