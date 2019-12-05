<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%activity}}`.
 */
class m191204_165918_add_columns_to_activity_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%activity}}', 'created_at', $this->timestamp()->defaultExpression("now()"));
        $this->addColumn('{{%activity}}', 'updated_at', $this->timestamp()->defaultExpression("now()"));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%activity}}', 'created_at');
        $this->dropColumn('{{%activity}}', 'updated_at');

    }
}
