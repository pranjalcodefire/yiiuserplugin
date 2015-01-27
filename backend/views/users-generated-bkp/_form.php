<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php echo  $form->field($model, 'first_name')->textInput(['maxlength' => 100]) ?>
    <?php echo  $form->field($model, 'last_name')->textInput(['maxlength' => 100]) ?>
    <?php echo  $form->field($model, 'email')->textInput(['maxlength' => 100]) ?>
    <?php echo  $form->field($model, 'username')->textInput(['maxlength' => 100]) ?>
    <?php echo  $form->field($model, 'password')->passwordInput(['maxlength' => 255]) ?>
    <?php echo  $form->field($model, 'auth_key')->textInput(['maxlength' => 32]) ?>
    <?php echo  $form->field($model, 'password_hash')->textInput(['maxlength' => 255]) ?>
    <?php echo  $form->field($model, 'password_reset_token')->textInput(['maxlength' => 255]) ?>
    <?php echo  $form->field($model, 'user_group_id')->textInput() ?>
    <?php echo  $form->field($model, 'role')->textInput() ?>
    <?php //echo  $form->field($model, 'fb_id')->textInput(['maxlength' => 100]) ?>
    <?php //echo  $form->field($model, 'fb_access_token')->textarea(['rows' => 6]) ?>
    <?php //echo  $form->field($model, 'twt_id')->textInput(['maxlength' => 100]) ?>
    <?php //echo  $form->field($model, 'twt_access_token')->textarea(['rows' => 6]) ?>
    <?php //echo  $form->field($model, 'twt_access_secret')->textarea(['rows' => 6]) ?>
    <?php //echo  $form->field($model, 'ldn_id')->textInput(['maxlength' => 100]) ?>
    <?php echo  $form->field($model, 'status')->textInput() ?>
    <?php //echo  $form->field($model, 'email_verified')->textInput() ?>
    <?php //echo  $form->field($model, 'last_login')->textInput() ?>
    <?php //echo  $form->field($model, 'by_admin')->textInput() ?>
    <?php //echo  $form->field($model, 'created')->textarea(['rows' => 6]) ?>
    <?php //echo  $form->field($model, 'modified')->textarea(['rows' => 6]) ?>
    <div class="form-group">
        <?php echo  Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
