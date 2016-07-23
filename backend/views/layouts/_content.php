<?php

use yii\bootstrap\Html;
use yii\helpers\Inflector;
use yii\widgets\Breadcrumbs;
use lo\modules\noty\Wrapper;

/* @var $this \yii\web\View */
/* @var $content string */
?>
<div class="content-wrapper">
    <section class="content-header">
        <?php if (isset($this->blocks['content-header'])) { ?>
            <h1><?= $this->blocks['content-header'] ?></h1>
        <?php } else { ?>
            <h1>
                <?php
                if ($this->title !== null) {
                    echo Html::encode($this->title);
                } else {
                    echo Inflector::camel2words(Inflector::id2camel($this->context->module->id));
                    echo ($this->context->module->id !== Yii::$app->id) ? '<small>Module</small>' : '';
                } ?>
            </h1>
        <?php } ?>

        <?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : []]) ?>
    </section>

    <section class="content">
        <?= Wrapper::widget() ?>
        <div class="box">
           <div class="box-body">
                <?= $content ?>
            </div>
        </div>
    </section>
</div>
