<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use common\assets\Highlight;
use dosamigos\disqus\Comments;

/* @var $this yii\web\View */
/* @var $model common\models\Article */

Highlight::register($this);

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Articles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-view">
    <article class="article-item">
        <h1><?= Html::encode($this->title) ?></h1>

        <div class="article-meta">
            <span class="glyphicon glyphicon-time"></span> <?= Yii::$app->formatter->asDatetime($model->published_at) ?>
            <span class="glyphicon glyphicon-folder-close"></span> <?= Html::a($model->category->title, ['article/category', 'slug' => $model->category->slug]) ?>
            <span class="glyphicon glyphicon-user"></span> <?= Html::a($model->author->username, ['account/default/view', 'id' => $model->author->id]) ?>
        </div>

        <div class="row">
            <div class="col-md-9">
                <div class="article-text">
                    <?= HtmlPurifier::process($model->body) ?>
                </div>

                <?php if ($model->tagValues) : ?>
                    <div class="article-meta">
                        <span class="glyphicon glyphicon-tags"></span> <?= $model->tagLinks ?>
                    </div>
                <?php endif ?>

                <hr/>
                <!--noindex-->
                    <?= Comments::widget([
                        'shortname' => env('SHORT_NAME'),
                        'identifier' => Html::encode($model->slug),
                    ]) ?>
                <!--/noindex-->
            </div>

            <div class="col-md-3">
                <?= $this->render(
                    '_categoryItem.php',
                    ['menuItems' => $menuItems]
                ) ?>
            </div>
        </div>
    </article>
</div>
