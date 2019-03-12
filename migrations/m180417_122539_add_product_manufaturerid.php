<?php

use yii\db\Migration;

/**
 * Class m180417_122539_add_product_manufaturerid
 */
class m180417_122539_add_product_manufaturerid extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      //  $this->addColumn('product', 'manufacturer_id', $this->integer()->after('profile_id'));
        $this->addForeignKey(
            "fk-product-manufacturer_id",
            "product",
            "manufacturer_id",
            "manufacturer",
            "id",
            "CASCADE"
        );

//        $this->addForeignKey(
//            'fk-profile-user_id',
//            'profile',
//            'user_id',
//            'user',
//            'id',
//            'CASCADE'
//        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        //$this->dropColumn('product', 'manufacturer_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180417_122539_add_product_manufaturerid cannot be reverted.\n";

        return false;
    }
    */
}
