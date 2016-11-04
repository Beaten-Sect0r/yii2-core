<?php

use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model frontend\models\ContactForm */

$this->title = Yii::t('frontend', 'Contact');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin() ?>

        <?= $form->field($model, 'name') ?>

        <?= $form->field($model, 'email') ?>

        <?= $form->field($model, 'subject') ?>

        <?= $form->field($model, 'body')->textArea(['rows' => 6]) ?>

        <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
            'captchaAction' => '/site/captcha',
            'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
        ]) ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('frontend', 'Send'), ['class' => 'btn btn-primary']) ?>
         </div>

    <?php ActiveForm::end() ?>
</div>
