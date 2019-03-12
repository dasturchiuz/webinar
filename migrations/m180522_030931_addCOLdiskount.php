<?php

use yii\db\Migration;

/**
 * Class m180522_030931_addCOLdiskount
 */
class m180522_030931_addCOLdiskount extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%discount}}', 'discount_name');
        $this->addColumn('{{%discount}}', 'discount_name', $this->string(25)->after('product_id'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180522_030931_addCOLdiskount cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180522_030931_addCOLdiskount cannot be reverted.\n";

        return false;
    }
    */
}
