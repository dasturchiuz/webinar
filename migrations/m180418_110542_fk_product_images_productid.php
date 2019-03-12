<?php

use yii\db\Migration;

/**
 * Class m180418_110542_fk_product_images_productid
 */
class m180418_110542_fk_product_images_productid extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            "fk-images-id",
            "product_images",
            "product_id",
            "product",
            "id",
            "CASCADE"
        );
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
        echo "m180418_110542_fk_product_images_productid cannot be reverted.\n";

        return false;
    }
    */
}
