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
    <div class="col-md-6"><?php echo Html::a('View Group', Url::to(['user-group/view', 'id'=>$model->id]), ['class'=>'btn btn-success pull-right']);?></div>
</div>
<?php echo Alert::widget() ?>
<?php $form = ActiveForm::begin();?>
<div class="row">
    <div class="col-md-4">
        <?php 
        echo $form->field($model, 'name')->textInput(['placeholder'=>'Please enter group name'])->label($model->getAttributeLabel('name'));
        echo $form->field($model, 'alias_name')->textInput(['placeholder'=>'Please enter alias name for group'])->label($model->getAttributeLabel('alias_name'));
        echo $form->field($model, 'allowRegistration')->checkbox();
        echo Html::submitButton('Submit', ['class'=>'btn btn-success']);
        ?>
    </div>
</div>
<?php ActiveForm::end();?>


