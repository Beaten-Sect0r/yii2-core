<?php

use yii\bootstrap\Html;
use backend\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

if (Yii::$app->controller->action->id === 'login') {
    echo $this->render(
        'main-login',
        ['content' => $content]
    );
} else {
    AppAsset::register($this);
?>
    <?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <?= Html::beginTag('body', [
        'class' => implode(' ', array_filter([
            'hold-transition',
            Yii::$app->keyStorage->get('backend.theme-skin', 'skin-blue'),
            Yii::$app->keyStorage->get('backend.layout-fixed') ? 'fixed' : null,
            Yii::$app->keyStorage->get('backend.layout-boxed') ? 'layout-boxed' : null,
            Yii::$app->keyStorage->get('backend.layout-collapsed-sidebar') ? 'sidebar-collapse' : null,
            Yii::$app->keyStorage->get('backend.layout-mini-sidebar') ? 'sidebar-mini' : null,
        ])),
    ]) ?>
    <?php $this->beginBody() ?>
    <div class="wrapper">
        <?= $this->render('_header.php') ?>

        <?= $this->render('_left.php') ?>

        <?= $this->render(
            '_content.php',
            ['content' => $content]
        ) ?>
    </div>
    <?php $this->endBody() ?>
    <?= Html::endTag('body') ?>
    </html>
    <?php $this->endPage() ?>
<?php } ?>
