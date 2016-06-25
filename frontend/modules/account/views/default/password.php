<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\account\models\PasswordForm */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('frontend', 'Change password');
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Settings'), 'url' => ['settings']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-default-password">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin() ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_confirm')->passwordInput(['maxlength' => true])?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('frontend', 'Update'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end() ?>
</div>
