<?php

use yii\helpers\ArrayHelper;
use yii\web\Application;

// Composer
require(__DIR__ . '/../../vendor/autoload.php');

// Environment
require(__DIR__ . '/../../common/env.php');

// Yii2
require(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');

// Bootstrap application
require(__DIR__ . '/../../common/config/bootstrap.php');
require(__DIR__ . '/../config/bootstrap.php');

$config = ArrayHelper::merge(
    require(__DIR__ . '/../../common/config/main.php'),
    require(__DIR__ . '/../config/main.php')
);

if (YII_ENV_DEV) {
    // показываем ошибки
    error_reporting(-1);
} else {
    // не показываем ошибки
    error_reporting(0);
}

(new Application($config))->run();
