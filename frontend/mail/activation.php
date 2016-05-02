<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$activationLink = Yii::$app->urlManager->createAbsoluteUrl(['account/sign-in/confirm-email', 'id' => $user->id, 'token' => $user->access_token]);
?>
<?= Yii::t('frontend', 'Hello {username}, follow the link below to confirm your email:', ['username' => $user->username]) ?>

<?= Html::a(Html::encode($activationLink), $activationLink) ?>
