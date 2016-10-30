<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;
use yii\helpers\Console;
use common\models\User;
use common\rbac\OwnModelRule;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        $user = $auth->createRole(User::ROLE_USER);
        $user->description = 'User';
        $auth->add($user);

        // own model rule
        $ownModelRule = new OwnModelRule();
        $auth->add($ownModelRule);

        $manager = $auth->createRole(User::ROLE_MANAGER);
        $manager->description = 'Manager';
        $auth->add($manager);
        $auth->addChild($manager, $user);

        $loginToBackend = $auth->createPermission('loginToBackend');
        $loginToBackend->description = 'Login to backend';
        $auth->add($loginToBackend);
        $auth->addChild($manager, $loginToBackend);

        $admin = $auth->createRole(User::ROLE_ADMINISTRATOR);
        $admin->description = 'Administrator';
        $auth->add($admin);
        $auth->addChild($admin, $manager);

        $auth->assign($admin, 1);

        Console::output('Success! RBAC roles has been added.');
    }
}
