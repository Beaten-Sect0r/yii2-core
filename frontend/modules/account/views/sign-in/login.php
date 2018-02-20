<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model common\models\LoginForm */

$this->title = Yii::t('frontend', 'Login');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-sign-in-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin() ?>

        <?= $form->field($model, 'identity')->textInput() ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <div class="form-group">
            <div class="btn-group">
                <?php if (Yii::$app->keyStorage->get('frontend.registration')) {
                    echo Html::a(Yii::t('frontend', 'Signup'), ['sign-in/signup'], ['class' => 'btn btn-success']);
                }?>

                <?= Html::a(Yii::t('frontend', 'Lost password'), ['sign-in/request-password-reset'], ['class' => 'btn btn-danger']) ?>
            </div>
        </div>
                
        <?= $form->field($model, 'rememberMe')->checkbox() ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('frontend', 'Login'), ['class' => 'btn btn-primary']) ?>
        </div>

    <?php ActiveForm::end() ?>
</div>
