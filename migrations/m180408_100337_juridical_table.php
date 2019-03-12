<?php

use yii\db\Migration;
use yii\db\Schema;
/**
 * Class m180408_100337_juridical_table
 */
class m180408_100337_juridical_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%juridical}}', [
            'id'=> Schema::TYPE_PK,
            'tashkilot'=>Schema::TYPE_STRING . '(255) NOT NULL',
            'bank'=>Schema::TYPE_STRING . '(200) NOT NULL',
            'hisobraqam'=>Schema::TYPE_INTEGER . ' NOT NULL',
            'inn'=>Schema::TYPE_SMALLINT . ' NOT NULL',
            'oked'=>Schema::TYPE_SMALLINT . ' NOT NULL',
            'mfo'=>Schema::TYPE_SMALLINT . ' NOT NULL',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);

        $this->addForeignKey(
            'fk-juridical-id',
            'juridical',
            'id',
            'user',
            'id',
            'CASCADE'
        );

    }

    public function down()
    {
        $this->dropTable('juridical');
    }
}
