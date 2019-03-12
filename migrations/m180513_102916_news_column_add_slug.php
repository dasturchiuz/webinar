<?php

use yii\db\Migration;

/**
 * Class m180513_102916_news_column_add_slug
 */
class m180513_102916_news_column_add_slug extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%newscategory}}', 'slug', $this->string()->after('category_name'));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%newscategory}}', 'slug');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180513_102916_news_column_add_slug cannot be reverted.\n";

        return false;
    }
    */
}
