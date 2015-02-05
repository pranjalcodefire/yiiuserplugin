<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use frontend\widgets\Alert;

$this->title = 'Change Password';
?>
<?php echo Alert::widget(); ?>
<?php $form = ActiveForm::begin();?>
<div class="row">
    <div class="col-md-5">
        <?php echo $form->field($model, 'old_password')->passwordInput(['placeholder'=>'Old Password'])->label($model->getAttributeLabel('old_password'));?>
        <?php echo $form->field($model, 'password')->passwordInput(['placeholder'=>'New Password'])->label($model->getAttributeLabel('New Password'));?>
        <?php echo $form->field($model, 'confirm_password')->passwordInput(['placeholder'=>'Confirm Password'])->label($model->getAttributeLabel('confirm_password'));?>
        <?php echo Html::submitButton('Change Password', ['class'=>'btn btn-success']);?>
    </div>
</div>
<?php ActiveForm::end();?>


