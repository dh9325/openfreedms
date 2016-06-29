<?php

use yii\db\Migration;

/**
 * Handles the creation for table `document`.
 */
class m160629_210007_create_table_document extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%document}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'reference_number' => $this->string()->notNull(),
            'revision_number' => $this->integer()->notNull(),
            'status' => $this->integer()->notNull(),
            'is_archived' => $this->boolean()->notNull(),
            'is_checked_out' => $this->boolean()->notNull(),
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
        $this->dropTable('{{%document}}');
    }
}
