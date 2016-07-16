<?php

use yii\db\Migration;

/**
 * Handles the creation for table `file_format`.
 */
class m160629_210003_create_table_file_format extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%file_format}}', [
            'id' => $this->primaryKey(),
            'extension' => $this->string(4)->notNull(),
            'created_at' => $this->integer()->notNull(),
            'created_by' => $this->string()->notNull()
        ]);
        $this->insert('{{%file_format}}', [
            'extension' => 'pdf',
            'created_at' => time(),
            'created_by' => 'm160629_210003_create_table_file_format'
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%file_format}}');
    }
}
