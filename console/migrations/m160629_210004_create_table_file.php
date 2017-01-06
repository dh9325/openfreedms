<?php

use yii\db\Migration;

/**
 * Handles the creation for table `file`.
 */
class m160629_210004_create_table_file extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%file}}', [
            'id' => $this->primaryKey(),
            'path' => $this->string(255)->notNull(),
            'file_format' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'created_by' => $this->string(255)->notNull()
        ]);
        $this->addForeignKey('fk_file_file_format', '{{%file}}', 'file_format', '{{%file_format}}', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%file}}');
    }
}
