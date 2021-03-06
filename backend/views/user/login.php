<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use frontend\widgets\Alert;

$this->title = 'Login';
//$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-login">
<!--    <h1><?= Html::encode($this->title) ?></h1>-->
    <?php echo Alert::widget();?>
    <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <?= $form->field($model, 'username')->textInput(['placeholder'=>$model->getAttributeLabel('username')])->label(false); ?>
                <?= $form->field($model, 'password')->passwordInput(['placeholder'=>$model->getAttributeLabel('password')])->label(false); ?>
                <?= $form->field($model, 'rememberMe')->checkbox() ?>
                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary pull-right', 'name' => 'login-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-lg-4"></div>
    </div>
</div>
