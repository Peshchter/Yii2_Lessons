<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m191202_052556_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(255)->notNull(),
            'password' => $this->string(255)->notNull(),
            'authKey' => $this->string(255)->notNull(),
            'accessToken' => $this->string(255)->notNull(),
        ]);
        $this->createIndex('idx_name', '{{%users}}','username');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%users}}');
    }
}
