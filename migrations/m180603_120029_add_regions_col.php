<?php

use yii\db\Migration;

/**
 * Class m180603_120029_add_regions_col
 */
class m180603_120029_add_regions_col extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
//        $this->addColumn('{{%regions}}', 'strana_id', $this->integer()->after('name_obl'));
//        $this->addForeignKey(
//            'fk-regions-strana-id',
//            'regions',
//            'strana_id',
//            'strana',
//            'id',
//            'CASCADE'
//        );
        $this->addForeignKey(
            'fk-cities-region-id',
            'cities',
            'region_id',
            'regions',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180603_120029_add_regions_col cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180603_120029_add_regions_col cannot be reverted.\n";

        return false;
    }
    */
}
