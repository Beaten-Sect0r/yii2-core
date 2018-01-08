<?php

use yii\db\Migration;

class m160101_000006_tag extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%tag}}', [
            'id' => $this->primaryKey(),
            'frequency' => $this->integer()->notNull(),
            'name' => $this->string(255)->notNull(),
            'slug' => $this->string(255)->notNull(),
            'comment' => $this->text(),
        ], $tableOptions);

        $this->createTable('{{%article_tag}}', [
            'article_id' => $this->integer()->notNull(),
            'tag_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey('pk_article_tag', '{{%article_tag}}', ['article_id', 'tag_id']);

        $this->addForeignKey('fk_tag-article_id-article-id', '{{%article_tag}}', 'article_id', '{{%article}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk_tag-tag_id-tag-id', '{{%article_tag}}', 'tag_id', '{{%tag}}', 'id', 'cascade', 'cascade');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_tag-tag_id-tag-id', '{{%article_tag}}');
        $this->dropForeignKey('fk_tag-article_id-article-id', '{{%article_tag}}');

        $this->dropTable('{{%article_tag}}');
        $this->dropTable('{{%tag}}');
    }
}
