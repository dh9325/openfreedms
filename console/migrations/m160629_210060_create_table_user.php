<?php

use common\models\Department;
use yii\db\Migration;

class m160629_210060_create_table_user extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'department' => $this->integer()->notNull(),
            'is_admin' => $this->boolean()->defaultValue(0),
            'is_master_admin' => $this->boolean()->defaultValue(0),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'created_by' => $this->string(255)->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'updated_by' => $this->string(255)->notNull(),
        ], $tableOptions);

        $this->insert('{{%user}}', [
            'username' => Yii::$app->get('masterAdmin')->username,
            'auth_key' => Yii::$app->security->generateRandomString(),
            'password_hash' => Yii::$app->security->generatePasswordHash(Yii::$app->get('masterAdmin')->password),
            'email' => Yii::$app->get('masterAdmin')->email,
            'department' => Department::findDefault()->id,
            'is_admin' => 1,
            'is_master_admin' => 1,
            'status' => 10,
            'created_at' => time(),
            'created_by' => 'm130524_201442_create_table_user',
            'updated_at' => time(),
            'updated_by' => 'm130524_201442_create_table_user'
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
