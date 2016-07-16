<?php

use yii\db\Migration;

/**
 * Handles the creation for table `contributor`.
 */
class m160716_132758_create_table_contributor extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%contributor}}', [
            'user_id' => $this->integer()->notNull(),
            'department_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'created_by' => $this->string()->notNull(),
        ]);
        $this->addPrimaryKey('pk', '{{%contributor}}', ['user_id', 'department_id']);
        $this->addForeignKey('fk_contributor_user', '{{%contributor}}', 'user_id', '{{%user}}', 'id');
        $this->addForeignKey('fk_contributor_department', '{{%contributor}}', 'department_id', '{{%department}}', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_contributor_department', '{{%contributor}}');
        $this->dropForeignKey('fk_contributor_user', '{{%contributor}}');
        $this->dropTable('{{%contributor}}');
    }
}
