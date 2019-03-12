<?php

use yii\db\Migration;

/**
 * Class m180608_095711_add_col_fkk
 */
class m180608_095711_add_col_fkk extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180608_095711_add_col_fkk cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180608_095711_add_col_fkk cannot be reverted.\n";

        return false;
    }
    */
}
