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
            'password_hash' => $this->string(255)->notNull(),
            'authKey' => $this->string(255)->notNull(),
            'accessToken' => $this->string(255)->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'role' => $this->string()->defaultValue('guest'),
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
