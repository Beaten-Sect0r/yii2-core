<?php

/* @var $this yii\web\View */
/* @var $model common\models\Menu */

$this->title = Yii::t('backend', 'Create item');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Menu'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-create">

    <?= $this->render('_form', [
        'model' => $model,
        'links' => $links,
    ]) ?>

</div>
