<?php

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/params.php')
);

$config = [
    'id' => 'app-backend',
    'homeUrl' => Yii::getAlias('@backendUrl'),
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'defaultRoute' => 'site/settings',
    'controllerMap' => [
        'file-manager-elfinder' => [
            'class' => 'mihaildev\elfinder\Controller',
            'access' => ['@'],
            'disabledCommands' => ['netmount'],
            'roots' => [
                [
                    'baseUrl' => '@storageUrl',
                    'basePath' => '@storage',
                    'path' => '/',
                    'access' => ['read' => 'manager', 'write' => 'manager'],
                    'options' => [
                       'attributes' => [
                            [
                                'pattern' => '#.*(\.gitignore|\.htaccess)$#i',
                                'read' => false,
                                'write' => false,
                                'hidden' => true,
                                'locked' => true,
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'components' => [
        'urlManager' => require(__DIR__ . '/_urlManager.php'),
        'frontendCache' => require(Yii::getAlias('@frontend/config/_cache.php')),
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => getenv('BACKEND_COOKIE_VALIDATION_KEY'),
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'modules' => [
        'webshell' => [
            'class' => 'samdark\webshell\Module',
            'yiiScript' => Yii::getAlias('@root') . '/yii', // adjust path to point to your ./yii script
            'allowedIPs' => ['*'],
            'as access' => [
                'class' => 'common\behaviors\GlobalAccessBehavior',
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['administrator'],
                    ],
                ],
            ],
        ],
    ],
    'as globalAccess' => [
        'class' => 'common\behaviors\GlobalAccessBehavior',
        'rules' => [
            [
                'controllers' => ['site'],
                'allow' => true,
                'actions' => ['login'],
                'roles' => ['?'],
            ],
            [
                'controllers' => ['site'],
                'allow' => true,
                'actions' => ['logout'],
                'roles' => ['@'],
            ],
            [
                'controllers' => ['site'],
                'allow' => true,
                'actions' => ['error'],
                'roles' => ['?', '@'],
            ],
            [
                'controllers' => ['user'],
                'allow' => true,
                'roles' => ['administrator'],
            ],
            [
                'controllers' => ['user'],
                'allow' => false,
            ],
            [
                'controllers' => ['db-manager'],
                'allow' => true,
                'roles' => ['administrator'],
            ],
            [
                'controllers' => ['db-manager'],
                'allow' => false,
            ],
            [
                'allow' => true,
                'roles' => ['manager'],
            ],
        ],
    ],
    'as beforeAction' => [
        'class' => 'common\behaviors\LastActionBehavior',
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['127.0.0.1', '::1'],
        'as access' => [
            'class' => 'common\behaviors\GlobalAccessBehavior',
            'rules' => [
                [
                    'allow' => true,
                ],
            ],
        ],
    ];
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1', '::1'],
        'as access' => [
            'class' => 'common\behaviors\GlobalAccessBehavior',
            'rules' => [
                [
                    'allow' => true,
                ],
            ],
        ],
    ];
}

return $config;
