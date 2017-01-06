<?php

use yii\db\Migration;

/**
 * Handles the creation for table `reviewer`.
 */
class m160716_132807_create_table_reviewer extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%reviewer}}', [
            'user_id' => $this->integer()->notNull(),
            'department_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'created_by' => $this->string()->notNull(),
        ]);
        $this->addPrimaryKey('pk', '{{%reviewer}}', ['user_id', 'department_id']);
        $this->addForeignKey('fk_reviewer_user', '{{%reviewer}}', 'user_id', '{{%user}}', 'id');
        $this->addForeignKey('fk_reviewer_department', '{{%reviewer}}', 'department_id', '{{%department}}', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_reviewer_department', '{{%reviewer}}');
        $this->dropForeignKey('fk_reviewer_user', '{{%reviewer}}');
        $this->dropTable('{{%reviewer}}');
    }
}
