<?php

use yii\db\Migration;

/**
 * Class m180629_053419_fk_orderid_invoiceid_created
 */
class m180629_053419_fk_orderid_invoiceid_created extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-invoice-created_by',
            'invoices',
            'created_by',
            'user',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-invoice-updated_by',
            'invoices',
            'updated_by',
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
        echo "m180629_053419_fk_orderid_invoiceid_created cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180629_053419_fk_orderid_invoiceid_created cannot be reverted.\n";

        return false;
    }
    */
}
