<?php
use yii\helpers\Html;

$verifyEmailLink = Yii::$app->urlManager->createAbsoluteUrl(['user/verify-my-email', 'id'=>$model->id, 'token' => $model->auth_key]);
?>

Hello <?= Html::encode($model->username) ?>,

Follow the link below to verify your email:

<?= Html::a(Html::encode($verifyEmailLink), $verifyEmailLink) ?>
