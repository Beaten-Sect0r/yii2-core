<?php

/* @var $this yii\web\View */
/* @var $model common\models\KeyStorageItem */

$this->title = Yii::t('backend', 'Update key storage item: {key}', ['key' => $model->key]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Key storage items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="key-storage-item-update">

    <?= $this->render('_form', ['model' => $model]) ?>

</div>
