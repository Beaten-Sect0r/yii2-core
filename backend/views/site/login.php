<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model common\models\LoginForm */

$this->title = Yii::t('backend', 'Sign in');
$this->params['breadcrumbs'][] = $this->title;
$this->params['body-class'] = 'login-page';
?>
<div class="login-box">

    <div class="login-logo">
        <?= Html::encode($this->title) ?>
    </div>

    <div class="login-box-body">
        <?php $form = ActiveForm::begin(['id' => 'login-form']) ?>

        <div class="body">
            <?= $form->field($model, 'identity') ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <?= $form->field($model, 'rememberMe')->checkbox(['class' => 'simple']) ?>
        </div>

        <div class="footer">
            <?= Html::submitButton('Sign me in', ['class' => 'btn btn-primary btn-flat btn-block']) ?>
        </div>

        <?php ActiveForm::end() ?>
    </div>

</div>
