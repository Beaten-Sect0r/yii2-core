<?php

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/params.php'
);

return [
    'id' => 'app-console',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'console\controllers',
    'bootstrap' => ['gii'],
    'controllerMap' => [
        'migrate' => [
            'class' => yii\console\controllers\MigrateController::class,
            'migrationPath' => [
                '@console/migrations',
                '@yii/rbac/migrations',
                '@yii/log/migrations',
            ],
        ],
    ],
    'modules' => [
        'gii' => 'yii\gii\Module',
        'db-manager' => [
            'class' => 'bs\dbManager\Module',
            // path to directory for the dumps
            'path' => '@root/backups',
            // list of registerd db-components
            'dbList' => ['db'],
        ],
    ],
    'params' => $params,
];
