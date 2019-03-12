<?php

use yii\db\Migration;

/**
 * Class m180522_040434_addColToDiscountStatus
 */
class m180522_040434_addColToDiscountStatus extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%discount}}', 'discount_name');
        $this->addColumn('{{%discount}}', 'discount_name', $this->string(25)->append('CHARACTER SET utf8 COLLATE utf8_general_ci')->after('product_id'));
        $this->addColumn('{{%discount}}', 'status', $this->tinyInteger()->after('product_id'));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180522_040434_addColToDiscountStatus cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180522_040434_addColToDiscountStatus cannot be reverted.\n";

        return false;
    }
    */
}
