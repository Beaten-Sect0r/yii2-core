<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use common\assets\Highlight;

/**
 * @var yii\web\View
 * @var common\models\Article
 */

Highlight::register($this);
?>

<hr/>
<div class="article-item">
    <h2 class="article-title">
        <?= Html::a($model->title, ['view', 'slug' => $model->slug]) ?>
    </h2>

    <div class="article-meta">
        <span class="glyphicon glyphicon-time"></span> <?= Yii::$app->formatter->asDatetime($model->published_at) ?>
        <span class="glyphicon glyphicon-folder-close"></span> <?= Html::a($model->category->title, ['article/category', 'slug' => $model->category->slug]) ?>
        <span class="glyphicon glyphicon-user"></span> <?= Html::a($model->author->username, ['account/default/view', 'id' => $model->author->id]) ?>
    </div>

    <div class="article-text">
        <?= HtmlPurifier::process($model->preview) ?>
    </div>

    <?php if ($model->tagValues) : ?>
        <div class="article-meta">
            <span class="glyphicon glyphicon-tags"></span> <?= $model->tagLinks ?>
        </div>
    <?php endif ?>
</div>
