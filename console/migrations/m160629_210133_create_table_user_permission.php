<?php

use yii\db\Migration;

/**
 * Handles the creation for table `user_permission`.
 */
class m160629_210133_create_table_user_permission extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%user_permission}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'document_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'created_by' => $this->string()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'updated_by' => $this->string()->notNull(),
        ]);
        $this->addForeignKey('fk_user_permission_user_id', '{{%user_permission}}', 'user_id', '{{%user}}', 'id');
        $this->addForeignKey('fk_user_permission_document_id', '{{%user_permission}}', 'document_id', '{{%document}}',
            'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_user_permission_document_id', '{{%user_permission}}');
        $this->dropForeignKey('fk_user_permission_user_id', '{{%user_permission}}');
        $this->dropTable('{{%user_permission}}');
    }
}
