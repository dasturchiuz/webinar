<?php

use yii\db\Migration;

/**
 * Class m180417_130314_add_column_manufacturer_image
 */
class m180417_130314_add_column_manufacturer_image extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('manufacturer', 'img_logo', $this->text()->after('code'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180417_130314_add_column_manufacturer_image cannot be reverted.\n";

        return false;
    }
    */
}
