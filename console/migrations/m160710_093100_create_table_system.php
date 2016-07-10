<?php

use yii\db\Migration;

/**
 * Handles the creation for table `table_system`.
 */
class m160710_093100_create_table_system extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%system}}', [
            'logo' => $this->string(255)->notNull(),
            'theme' => $this->string(255),
            'language' => $this->string(255),
            'authentication' => $this->string(255),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%system}}');
    }
}
