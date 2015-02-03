<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use frontend\widgets\Alert;

$this->title = 'All Settings';
?>
<div class="col-md-12">
<!--    <h4>All Settings</h4><hr>-->
    <?php echo Html::img(Yii::$app->homeUrl.'images/'.APP_IMAGES_DIRECTORY.'/'.AJAX_LOADING_BIG_IMAGE, ['class'=>'loading-img']);?>
    <?php echo Alert::widget();?>
    <?php if(!empty($results)) { ?>
    <?php echo Html::a('Add New', Url::to(['setting/save']), ['class'=>'btn btn-success pull-right btn-sm']);?>
    <table class="table table-hover table-bordered">
      <thead>
        <tr>
          <th>Setting ID</th>
          <th>Setting Description</th>
          <th>Value</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php //echo "<pre>";print_r($results);die;?>
        <?php  foreach($results as $result): ?>
            <tr class="success" id="rowId<?php echo $result->id;?>">
                <td><?php echo Html::encode($result->id);?></td>
                <td style="width:70%"><?php echo Html::encode($result->name_public);?></td>
                <td style='width:20%;text-align:center;'>
                    <?php if($result['type'] == 'checkbox') {
                        echo Html::checkbox($result->name, $result->value, ['id'=>'setting-'.$result->id]);
                    }else{
                        echo Html::textInput($result->name, $result->value, ['id'=>'setting-'.$result->id, 'class'=>'form-control']);
                    }?>
                </td>
                <td style="text-align:center;">
                    <?php echo Html::submitButton('Submit', ['class'=>'btn btn-sm btn-success ableToUpdateValue', 'id'=>'ableToUpdateValue'.$result->id]);?>
                </td>
            </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <div class="pull-right">
        
    </div>    
    <?php } ?>
</div>
<script>
    $('.ableToUpdateValue').click(function(){
        if(confirm('Are you sure ?')){ 
            var id = $(this).attr('id');
            var recordId  = id.split('ableToUpdateValue')[1];
            var value = $('#setting-'+recordId).is(':checkbox') ? (($('#setting-'+recordId).is(':checked') == true) ? 1 : 0)  : $('#setting-'+recordId).val(); 
            $.ajax({
              url:'<?php echo Url::to([Yii::$app->controller->id."/edit"])?>',
              type:"POST",
              data:'id='+recordId+'&value='+value,
              dataType:'json',
              beforeSend:function(){    $('.loading-img').show();    },
              success:function(response){
                    if(response.status == 'success'){
                        alert('Successfully Updated');
                    }
              },
              complete:function (){$('.loading-img').hide();},
              error:function(){ alert('There was a problem while requesting to verify email. Please try again');   }
           });
        }   
    });
</script>


