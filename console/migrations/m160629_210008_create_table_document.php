#<?php

use yii\db\Migration;

/**
 * Handles the creation for table `document`.
 */
class m160629_210008_create_table_document extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%document}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'reference_number' => $this->string()->unique()->notNull(),
            'revision_number' => $this->integer()->notNull(),
            'document_category' => $this->integer()->notNull(),
            'department' => $this->integer()->notNull(),
            'workflow' => $this->integer()->notNull(),
            'file' => $this->integer()->notNull(),
            'status' => $this->integer()->notNull(),
            'is_archived' => $this->boolean()->defaultValue(0),
            'is_checked_out' => $this->boolean()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'created_by' => $this->string()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'updated_by' => $this->string()->notNull(),
        ]);
        $this->addForeignKey('fk_document_document_category', '{{%document}}', 'document_category', '{{%document_category}}', 'id');
        $this->addForeignKey('fk_document_department', '{{%document}}', 'department', '{{%department}}', 'id');
        $this->addForeignKey('fk_document_workflow', '{{%document}}', 'workflow', '{{%workflow}}', 'id');
        $this->addForeignKey('fk_document_file', '{{%document}}', 'file', '{{%file}}', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%document}}');
    }
}
