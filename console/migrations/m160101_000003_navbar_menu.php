<?php

use yii\db\Migration;

class m160101_000003_navbar_menu extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%navbar_menu}}', [
            'id' => $this->primaryKey(),
            'url' => $this->string(255)->notNull(),
            'label' => $this->string(255)->notNull(),
            'parent_id' => $this->integer(),
            'status' => $this->smallInteger()->notNull(),
            'sort_index' => $this->integer(),
        ], $tableOptions);

        $this->addForeignKey('parent', '{{%navbar_menu}}', 'parent_id', '{{%navbar_menu}}', 'id', 'cascade', 'cascade');
    }

    public function down()
    {
        $this->dropTable('{{%navbar_menu}}');
    }
}
