<?php

use backend\components\sypexDumper\SypexDumper;

/* @var $this yii\web\View */

$this->title = Yii::t('backend', 'DB manager');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="db-manager-index">

    <?= SypexDumper::widget() ?>

</div>
