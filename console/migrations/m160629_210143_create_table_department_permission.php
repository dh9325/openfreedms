<?php

use yii\db\Migration;

/**
 * Handles the creation for table `department_permission`.
 */
class m160629_210143_create_table_department_permission extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%department_permission}}', [
            'id' => $this->primaryKey(),
            'department_id' => $this->integer()->notNull(),
            'document_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'created_by' => $this->string()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'updated_by' => $this->string()->notNull(),
        ]);
        $this->addForeignKey('fk_department_permission_user_id', '{{%department_permission}}', 'department_id',
            '{{%department}}',
            'id');
        $this->addForeignKey('fk_department_permission_document_id', '{{%department_permission}}', 'document_id',
            '{{%document}}',
            'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_department_permission_user_id', '{{%department_permission}}');
        $this->dropForeignKey('fk_department_permission_document_id', '{{%department_permission}}');
        $this->dropTable('{{%department_permission}}');
    }
}
