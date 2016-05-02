<?php

use yii\db\Migration;

class m160101_000005_menu extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%menu}}', [
            'id' => $this->primaryKey(),
            'url' => $this->string(255)->notNull(),
            'label' => $this->string(255)->notNull(),
            'parent_id' => $this->integer(),
            'status' => $this->smallInteger()->notNull(),
            'sort_index' => $this->integer(),
        ], $tableOptions);

        $this->addForeignKey('parent', '{{%menu}}', 'parent_id', '{{%menu}}', 'id', 'cascade', 'cascade');
    }

    public function down()
    {
        $this->dropTable('{{%menu}}');
    }
}
