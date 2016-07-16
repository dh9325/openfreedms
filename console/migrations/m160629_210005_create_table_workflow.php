<?php

use yii\db\Migration;

/**
 * Handles the creation for table `workflow`.
 */
class m160629_210005_create_table_workflow extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%workflow}}', [
            'id' => $this->primaryKey(),
            'steps' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'created_by' => $this->string()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'updated_by' => $this->string()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%workflow}}');
    }
}
