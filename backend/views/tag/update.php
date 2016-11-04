<?php

/* @var $this yii\web\View */
/* @var $model common\models\Tag */

$this->title = Yii::t('backend', 'Update tag: {name}', ['name' => $model->name]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Tags'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="tag-update">

    <?= $this->render('_form', ['model' => $model]) ?>

</div>
