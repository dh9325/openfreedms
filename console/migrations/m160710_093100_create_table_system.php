<?php

use common\models\System;
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
        $this->createTable('{{%system}}', array(
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->defaultValue('Open Free DMS'),
            'logo' => $this->string(255),
            'theme' => $this->string(255),
            'language' => $this->string(255)->defaultValue(System::DEFAULT_LOCALE)->notNull(),
            'authentication' => $this->string(255)->defaultValue(System::AUTH_METHOD_SQL)->notNull(),
            'data_path' => $this->string(255)->defaultValue(System::DEFAULT_DATA_PATH)->notNull(),
            'revision_path' => $this->string(255)->defaultValue(System::DEFAULT_DATA_REVISION_PATH)->notNull(),
        ));
        $this->insert('{{%system}}', [
            'authentication' => System::AUTH_METHOD_SQL,
            'data_path' => System::DEFAULT_DATA_PATH,
            'revision_path' => System::DEFAULT_DATA_REVISION_PATH
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
