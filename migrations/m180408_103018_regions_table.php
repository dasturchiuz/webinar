<?php

use yii\db\Migration;
use yii\db\Schema;
/**
 * Class m180408_103018_regions_table
 */
class m180408_103018_regions_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%regions}}', [
            'id'=>  Schema::TYPE_PK,
            'name_obl'=>Schema::TYPE_STRING . '(64) NOT NULL',
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
        ]);


    }

    public function down()
    {
        $this->dropTable('regions');
    }
}
