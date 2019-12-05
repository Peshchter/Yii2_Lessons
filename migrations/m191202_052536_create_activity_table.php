<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%activity}}`.
 */
class m191202_052536_create_activity_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%activity}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'start' => $this->timestamp()->defaultExpression("now()"),
            'finish' => $this->timestamp()->defaultExpression("now()"),
            'repeatable' => $this->boolean()->notNull()->defaultValue(false),
            'user_id' => $this->integer()->notNull(),
            'description' => $this->text(),
            'blocker' => $this->boolean()->notNull()->defaultValue(false),
        ]);
        $this->createIndex('idx_start', '{{%activity}}', 'start');
        $this->createIndex('idx_user', '{{%activity}}', 'user_id');
        $this->addForeignKey('fk_users', '{{%activity}}', 'user_id', '{{%users}}', 'id' );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%activity}}');
    }
}
