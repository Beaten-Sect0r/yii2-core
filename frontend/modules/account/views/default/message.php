<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model frontend\modules\account\models\MessageForm */

$this->title = Yii::t('frontend', 'Send email');
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Users'), 'url' => ['users']];
$this->params['breadcrumbs'][] = ['label' => $user->username, 'url' => ['view', 'id' => $user->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-default-message">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin() ?>

        <?= $form->field($model, 'subject') ?>

        <?= $form->field($model, 'body')->textArea(['rows' => 6]) ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('frontend', 'Send'), ['class' => 'btn btn-primary']) ?>
        </div>

    <?php ActiveForm::end() ?>
</div>
