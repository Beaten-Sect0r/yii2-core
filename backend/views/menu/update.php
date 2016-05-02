<?php

/* @var $this yii\web\View */
/* @var $model common\models\Menu */

$this->title = Yii::t('backend', 'Update item: {label}', ['label' => $model->label]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Menu'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="menu-update">

    <?= $this->render('_form', [
        'model' => $model,
        'links' => $links,
    ]) ?>

</div>
