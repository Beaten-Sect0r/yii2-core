<?php

use yii\helpers\Html;

?>

<h1><?= Html::encode(Yii::$app->maintenance->message) ?></h1>
<div class="wrapper" id="DateCountdown" data-date="<?= Html::encode(Yii::$app->maintenance->time) ?>"></div>
