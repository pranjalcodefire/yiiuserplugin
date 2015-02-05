<?php
use yii\helpers\Html;

$verifyEmailLink = Yii::$app->urlManager->createAbsoluteUrl(['user/verify-my-email', 'id'=>$details->id, 'token' => $details->auth_key]);
?>

Hello <?= Html::encode($details->username) ?>,

Follow the link below to verify your email:

<?= Html::a(Html::encode($verifyEmailLink), $verifyEmailLink) ?>
