<?php

use yii\db\Migration;

class m160101_000001_user extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(255)->notNull(),
            'auth_key' => $this->string(32)->notNull(),
            'access_token' => $this->string(255),
            'password_hash' => $this->string(255)->notNull(),
            'email' => $this->string(255)->notNull(),
            'status' => $this->smallInteger()->notNull(),
            'ip' => $this->string(128),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'action_at' => $this->integer(),
        ], $tableOptions);

        $this->createTable('{{%user_profile}}', [
            'user_id' => $this->primaryKey(),
            'firstname' => $this->string(),
            'lastname' => $this->string(),
            'birthday' => $this->integer(),
            'avatar_path' => $this->string(255),
            'gender' => $this->smallInteger(1),
            'website' => $this->string(255),
            'other' => $this->string(),
        ], $tableOptions);

        $this->addForeignKey('fk_user', '{{%user_profile}}', 'user_id', '{{%user}}', 'id', 'cascade', 'cascade');
    }

    public function down()
    {
        $this->dropForeignKey('fk_user', '{{%user_profile}}');

        $this->dropTable('{{%user_profile}}');
        $this->dropTable('{{%user}}');
    }
}
