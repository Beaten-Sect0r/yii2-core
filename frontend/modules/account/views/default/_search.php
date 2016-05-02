<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\models\search\UserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="account-default-users-search">
    <?php $form = ActiveForm::begin([
        'action' => ['users'],
        'method' => 'get',
    ]) ?>

    <?= $form->field($model, 'username') ?>

    <?php ActiveForm::end() ?>
</div>
