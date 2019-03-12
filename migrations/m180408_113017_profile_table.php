<?php

use yii\db\Migration;
use yii\db\Schema;
/**
 * Class m180408_113017_profile_table
 */
class m180408_113017_profile_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%profile}}', [
            'user_id'=> Schema::TYPE_INTEGER . ' NOT NULL',
            'firstname'=>Schema::TYPE_STRING . '(32) NOT NULL',
            'lastname'=>Schema::TYPE_STRING . '(32) NOT NULL',
            'fathername'=>Schema::TYPE_STRING . '(32) NOT NULL',
            'tell'=>Schema::TYPE_STRING . '(32) NOT NULL',
            'role'=>Schema::TYPE_STRING . '(32) NOT NULL',
            'adress'=>Schema::TYPE_STRING . '(200) NOT NULL',
            'is_juridical' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 10',
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
            'region_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);
        $this->addPrimaryKey(
            'PK_PROFILE',
            'profile',
            'user_id'
        );


        $this->createIndex(
            'idx-profile-user_id',
            'profile',
            'user_id'
        );
        $this->addForeignKey(
            'fk-profile-user_id',
            'profile',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable('profile');
    }
}
