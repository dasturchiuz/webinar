<?php

use yii\db\Migration;

/**
 * Class m180514_113914_add_notify_table_foregin_key
 */
class m180514_113914_add_notify_table_foregin_key extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-notify-profile',
            '{{%notfications}}',
            'profile_id',
            '{{%profile}}',
            'user_id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-notify-type',
            '{{%notfications}}',
            'notfy_type_id',
            '{{%notify_type}}',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('{{%notfications}}', 'fk-notify-profile');
        $this->dropIndex('{{%notfications}}', 'fk-notify-type');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180514_113914_add_notify_table_foregin_key cannot be reverted.\n";

        return false;
    }
    */
}
