<?php

use yii\db\Migration;

/**
 * Class m180603_121634_add_fk_ad
 */
class m180603_121634_add_fk_ad extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-adresses-region-id',
            'adresses',
            'strana_id',
            'strana',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-adresses-oblast-id',
            'adresses',
            'oblast_id',
            'regions',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-cityid-cities-id',
            'adresses',
            'city_id',
            'cities',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180603_121634_add_fk_ad cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180603_121634_add_fk_ad cannot be reverted.\n";

        return false;
    }
    */
}
