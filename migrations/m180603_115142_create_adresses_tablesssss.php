<?php

use yii\db\Migration;

/**
 * Class m180603_115142_create_adresses_tablesssss
 */
class m180603_115142_create_adresses_tablesssss extends Migration
{
    public function safeUp()
    {
        $this->createTable('adresses', [
            'id' => $this->primaryKey(),
            'strana_id'=>$this->integer(),
            'oblast_id'=>$this->integer(),
            'city_id'=>$this->integer(),
            'pochta_index'=>$this->tinyInteger(),
            'street'=>$this->string(255),
            'house'=>$this->string(50),
            'room'=>$this->string(50),
            'orientir'=>$this->string(255),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('adresses');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180603_115142_create_adresses_tablesssss cannot be reverted.\n";

        return false;
    }
    */
}
