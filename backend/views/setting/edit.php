<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use frontend\widgets\Alert;

$this->title = 'Edit Profile';
?>
<div class="row">
    <div class="col-md-6">
<!--        <h3><strong>Welcome <?php echo (!empty($model->first_name)) ? (Html::encode($model->first_name).', ') : ''; ?></strong></h3><hr style="border-color:grey;">-->
    </div>
    <div class="col-md-6"><?php echo Html::a('View User Profile', Url::to(['user/view', 'id'=>$model->id]), ['class'=>'btn btn-success pull-right']);?></div>
</div>
<?php echo Alert::widget() ?>
<?php $form = ActiveForm::begin();?>
<div class="row">
    <div class="col-md-2">
        <a href="javascript:(void())" class="thumbnail">
            <?php 
                //if(!empty($model->userDetail->photo)){
                //    echo Html::img(Yii::$app->homeUrl.'images/'.USER_PROFILE_IMAGES_DIRECTORY.'/'.$model->userDetail->photo, ['height'=> '150px','width'=> '150px']);
                //}else{
                    echo Html::img(Yii::$app->homeUrl.'images/'.USER_PROFILE_IMAGES_DIRECTORY.'/'.USER_PROFILE_DEFAULT_IMAGE, ['height'=> '150px','width'=> '150px']);
                //}
            ?>
        </a>
    </div>
    <div class="col-md-5">
        <?php echo $form->field($model, 'username')->textInput(['placeholder'=>'Please enter a Username', 'class'=>'form-control', 'readOnly'=>true])->label($model->getAttributeLabel('username'));?>
        <div class="row">
            <div class="col-md-6">
                <?php echo $form->field($model, 'first_name')->textInput(['placeholder'=>'First name'])->label($model->getAttributeLabel('first_name'));?>
            </div>
            <div class="col-md-6">
                <?php echo $form->field($model, 'last_name')->textInput(['placeholder'=>'Last name'])->label($model->getAttributeLabel('last_name'));?>
            </div>
        </div>        
        <div class="row">
            <div class="col-md-6">
                <?php echo $form->field($model->userDetail, 'gender')->dropDownList($genderOptions, ['prompt'=>'Please Select', 'title'=>'Please select gender'])->label($model->getAttributeLabel('gender'));?>
            </div>
            <div class="col-md-6">
                <?php echo $form->field($model->userDetail, 'marital_status')->dropDownList($maritalOptions,['prompt'=>'Please Select', 'title'=>'Please select marital status'])->label($model->getAttributeLabel('marital_status'));?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?php echo $form->field($model->userDetail, 'bday')->textInput(['placeholder'=>'Birth date', 'class'=>'form-control datepicker'])->label($model->getAttributeLabel('bday'));?>
            </div>
            <div class="col-md-6">
                <?php echo $form->field($model->userDetail, 'cellphone')->textInput(['placeholder'=>'Phone'])->label($model->getAttributeLabel('cellphone'));?>
            </div>
        </div>
        <?php echo $form->field($model->userDetail, 'location')->textInput(['placeholder'=>'Please enter your location'])->label($model->getAttributeLabel('location'));?>
        <?php echo $form->field($model->userDetail, 'web_page')->textInput(['placeholder'=>'Please enter your webpage'])->label($model->getAttributeLabel('webpage'));?>
    </div>
    <div class="col-md-5">
        <?php echo $form->field($model, 'email')->textInput(['placeholder'=>'Please enter your EMail Id'])->label($model->getAttributeLabel('email'));?>
        <?php //echo $form->field($model->userDetail, 'photo')->fileInput(['placeholder'=>'Please upload your photo'])->label($model->getAttributeLabel('Photo')); ?>
        <?php echo Html::submitButton('Submit', ['class'=>'btn btn-success']);?>
    </div>
</div>
<?php ActiveForm::end();?>


