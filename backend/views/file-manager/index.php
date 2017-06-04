<?php

use mihaildev\elfinder\ElFinder;

/* @var $this yii\web\View */

$this->title = Yii::t('backend', 'File manager');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-manager-index">

    <?= ElFinder::widget([
        'controller' => 'elfinder',
        'frameOptions' => ['style' => 'min-height: 500px; width: 100%; border: 0'],
    ]) ?>

</div>
