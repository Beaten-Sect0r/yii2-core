<?php

use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model frontend\modules\account\models\PasswordResetRequestForm */

$this->title = Yii::t('frontend', 'Request password reset');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-sign-in-request-password-reset">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin() ?>

        <?= $form->field($model, 'email')->textInput() ?>

        <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
            'captchaAction' => '/site/captcha',
            'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
        ]) ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('frontend', 'Send'), ['class' => 'btn btn-primary']) ?>
        </div>

    <?php ActiveForm::end() ?>
</div>
