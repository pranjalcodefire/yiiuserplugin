<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use frontend\widgets\Alert;

$this->title = 'All Roles';
?>
<div class="col-md-12">
<!--    <h4>All Groups</h4><hr>-->
    <?php echo Html::img(Yii::$app->homeUrl.'images/'.APP_IMAGES_DIRECTORY.'/'.AJAX_LOADING_BIG_IMAGE, ['class'=>'loading-img']);?>
    <?php echo Alert::widget();?>
    <?php if(!empty($results)) { //$i = (intval($pagination->offset) + 1);?>
    <?php echo Html::a('Add New', Url::to(['user-group/save']), ['class'=>'btn btn-success pull-right btn-sm']);?>
    <table class="table table-hover table-bordered">
      <thead>
        <tr>
          <th>Group ID</th>
          <th>Name</th>
          <th>Created</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php $i =1;foreach($results as $result):?>
            <tr class="success" id="rowId<?php //echo $result->id;?>">
                <td><?php echo $i;?></td>
                <td><?php echo Html::encode($result->name);?></td>
                <td><?php echo date(DATE_FORMAT, ($result->created_at));?></td>
                <td>
                    <?php //echo Html::a('<span class="glyphicon glyphicon-file"></span>', Url::to(['user-group/view', 'id'=>$result->id]), ['title'=>'View Group Profile']);?>
                    <?php //echo Html::a('<span class="glyphicon glyphicon-edit"></span>', Url::to(['user-group/edit', 'id'=>$result->id]), ['title'=>'Edit Group Details']);?>
                    <?php //echo Html::a('<span class="glyphicon glyphicon-remove-circle"></span>', 'javascript:void(0)', ['title'=>'Delete this Group', 'class'=>'ableToDelete', 'id'=>'ableToDelete'.$result->id,  'url'=>Url::to([Yii::$app->controller->id."/delete"])]);?>
                </td>
            </tr>
        <?php $i++;endforeach; ?>
      </tbody>
    </table>
    <div class="pull-right">
        <?php //echo LinkPager::widget(['pagination'=>$pagination]);?>
    </div>    
    <?php } ?>
    
</div>



