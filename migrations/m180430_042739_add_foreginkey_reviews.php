<?php

use yii\db\Migration;

/**
 * Class m180430_042739_add_foreginkey_reviews
 */
class m180430_042739_add_foreginkey_reviews extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-reviews-product-id',
            '{{%product_reviews}}',
            'product_id',
            '{{%product}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-reviews-user-id',
            '{{%product_reviews}}',
            'user_id',
            '{{%profile}}',
            'user_id',
            'CASCADE'
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
        echo "m180430_042739_add_foreginkey_reviews cannot be reverted.\n";

        return false;
    }
    */
}
