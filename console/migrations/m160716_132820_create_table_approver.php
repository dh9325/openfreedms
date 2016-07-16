<?php

use yii\db\Migration;

/**
 * Handles the creation for table `approver`.
 */
class m160716_132820_create_table_approver extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%approver}}', [
            'user_id' => $this->integer()->notNull(),
            'department_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'created_by' => $this->string()->notNull(),
        ]);
        $this->addPrimaryKey('pk', '{{%approver}}', ['user_id', 'department_id']);
        $this->addForeignKey('fk_approver_user', '{{%approver}}', 'user_id', '{{%user}}', 'id');
        $this->addForeignKey('fk_approver_department', '{{%approver}}', 'department_id', '{{%department}}', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_approver_department', '{{%approver}}');
        $this->dropForeignKey('fk_approver_user', '{{%approver}}');
        $this->dropTable('{{%approver}}');
    }
}
