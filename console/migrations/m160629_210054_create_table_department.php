<?php

use yii\db\Migration;

/**
 * Handles the creation for table `department`.
 */
class m160629_210054_create_table_department extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%department}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'status' => $this->integer()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'created_by' => $this->string()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'updated_by' => $this->string()->notNull(),
        ]);

        $this->insert('{{%department}}', [
            'name' => Yii::$app->get('masterAdmin')->department,
            'created_at' => time(),
            'created_by' => 'm160629_210054_create_table_department',
            'updated_at' => time(),
            'updated_by' => 'm160629_210054_create_table_department'
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%department}}');
    }
}
