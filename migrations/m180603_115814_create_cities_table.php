<?php

use yii\db\Migration;

/**
 * Handles the creation of table `cities`.
 */
class m180603_115814_create_cities_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('cities', [
            'id' => $this->primaryKey(),
            'city_name'=>$this->string(100),
            'region_id'=>$this->string(100),
            'sort_city'=>$this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('cities');
    }
}
