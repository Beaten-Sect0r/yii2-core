<?php

use yii\bootstrap\Html;

/* @var $this yii\web\View */

$this->title = Yii::t('backend', 'Assets');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assets-index">

    <p>
        <?= Html::a(Yii::t('backend', 'Clear') . ' ' . Yii::getAlias('@backend/web/assets'), ['/system/clear-assets', 'type' => 'backend'], ['class' => 'btn btn-danger']) ?>
        <?= Html::a(Yii::t('backend', 'Clear') . ' ' . Yii::getAlias('@frontend/web/assets'), ['/system/clear-assets', 'type' => 'frontend'], ['class' => 'btn btn-danger']) ?>
    </p>

</div>
