<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

/* @var $this yii\web\View */
/* @var $model common\models\Page */

$this->title = $model->title;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-view">
    <h1><?= Html::encode($model->title) ?></h1>

    <?= HtmlPurifier::process($model->body) ?>
</div>
