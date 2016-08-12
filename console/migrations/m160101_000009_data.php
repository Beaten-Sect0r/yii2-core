<?php

use yii\db\Migration;
use common\models\Menu;
use common\models\Page;
use common\models\User;

class m160101_000009_data extends Migration
{
    public function safeUp()
    {
        $this->insert('{{%user}}', [
            'id' => 1,
            'username' => 'Administrator',
            'auth_key' => Yii::$app->getSecurity()->generateRandomString(),
            'access_token' => Yii::$app->getSecurity()->generateRandomString(),
            'password_hash' => Yii::$app->getSecurity()->generatePasswordHash('passwd'),
            'email' => 'webmaster@example.com',
            'status' => User::STATUS_ACTIVE,
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        $this->insert('{{%user_profile}}', [
            'user_id' => 1,
        ]);

        $this->insert('{{%menu}}', [
            'url' => 'page/about',
            'label' => 'About',
            'status' => Menu::STATUS_ACTIVE,
        ]);

        $this->insert('{{%page}}', [
            'slug' => 'about',
            'title' => 'About',
            'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'status' => Page::STATUS_ACTIVE,
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        $this->insert('{{%key_storage_item}}', [
            'key' => 'frontend.registration',
            'value' => 1,
        ]);
        $this->insert('{{%key_storage_item}}', [
            'key' => 'frontend.email-confirm',
            'value' => 1,
        ]);
        $this->insert('{{%key_storage_item}}', [
            'key' => 'frontend.maintenance',
            'value' => 0,
        ]);
        $this->insert('{{%key_storage_item}}', [
            'key' => 'backend.theme-skin',
            'value' => 'skin-blue',
        ]);
        $this->insert('{{%key_storage_item}}', [
            'key' => 'backend.layout-fixed',
            'value' => 0,
        ]);
        $this->insert('{{%key_storage_item}}', [
            'key' => 'backend.layout-boxed',
            'value' => 0,
        ]);
        $this->insert('{{%key_storage_item}}', [
            'key' => 'backend.layout-collapsed-sidebar',
            'value' => 0,
        ]);
        $this->insert('{{%key_storage_item}}', [
            'key' => 'backend.layout-mini-sidebar',
            'value' => 0,
        ]);
    }

    public function safeDown()
    {
        $this->delete('{{%key_storage_item}}', [
            'key' => [
                'backend.theme-skin',
                'backend.layout-fixed',
                'backend.layout-boxed',
                'backend.layout-collapsed-sidebar',
                'backend.layout-mini-sidebar',
            ],
        ]);

        $this->delete('{{%key_storage_item}}', [
            'key' => 'frontend.registration',
            'key' => 'frontend.email-confirm',
            'key' => 'frontend.maintenance',
        ]);

        $this->delete('{{%page}}', [
            'slug' => 'about',
        ]);

        $this->delete('{{%menu}}', [
            'url' => 'page/about'
        ]);

        $this->delete('{{%user_profile}}', [
            'user_id' => 1,
        ]);

        $this->delete('{{%user}}', [
            'id' => 1,
        ]);
    }
}
