<?php

/* @var $this yii\web\View */
/* @var $model common\models\KeyStorageItem */

$this->title = Yii::t('backend', 'Create key storage item');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Key storage items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="key-storage-item-create">

    <?= $this->render('_form', ['model' => $model]) ?>

</div>
