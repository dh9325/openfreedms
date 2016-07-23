<?php

use common\models\Workflow;
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
            'created_at' => $this->integer()->notNull(),
            'created_by' => $this->string()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'updated_by' => $this->string()->notNull(),
        ]);
        $this->insert('{{%workflow}}', [
            'id' => Workflow::TYPE_NO_APPROVAL,
        ]);
        $this->insert('{{%workflow}}', [
            'id' => Workflow::TYPE_ONE_LEVEL_APPROVAL,
        ]);
        $this->insert('{{%workflow}}', [
            'id' => Workflow::TYPE_TWO_LEVEL_APPROVAL,
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
