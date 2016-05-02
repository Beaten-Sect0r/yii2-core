<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['account/sign-in/reset-password', 'token' => $user->access_token]);
?>
<?= Yii::t('frontend', 'Hello {username}, follow the link below to reset your password:', ['username' => $user->username]) ?>

<?= Html::a(Html::encode($resetLink), $resetLink) ?>
