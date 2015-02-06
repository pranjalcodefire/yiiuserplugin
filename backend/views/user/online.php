<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use frontend\widgets\Alert;

$this->title = 'All User Activities';
?>
<div class="col-md-12">
<!--    <h4>All Users</h4><hr>-->
    <?php echo Html::img(Yii::$app->homeUrl.'images/'.APP_IMAGES_DIRECTORY.'/'.AJAX_LOADING_BIG_IMAGE, ['class'=>'loading-img']);?>
    <?php echo Alert::widget();?>
    <?php if(!empty($results)) { $i = (intval($pagination->offset) + 1);?>
    <table class="table table-hover table-bordered">
      <thead>
        <tr>
          <th>User ID</th>
          <th>Name</th>
          <th>Username</th>
          <th>Email</th>
          <th>Last Url</th>
          <th>Browser</th>
          <th>IP Address</th>
          <th>Last Seen</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($results as $result): ?>
            <tr class="<?php echo ($result->status == ACTIVE) ? 'success' : 'danger'; ?>" id="rowId<?php echo $result->id;?>">
                <td><?php echo Html::encode($result->user_id);?></td>
                <td><?php echo !empty($result->name) ? Html::encode($result->name) : 'Guest';?></td>
                <td><?php echo !empty($result->username) ? Html::encode($result->username) : NOT_FOUND_TEXT;?></td>
                <td><?php echo !empty($result->email) ? Html::encode($result->email) : NOT_FOUND_TEXT;?></td>
                <td><?php echo Html::encode($result->last_url);?></td>
                <td><?php echo Html::encode($result->user_browser);?></td>
                <td><?php echo Html::encode($result->ip_address);?></td>
                <td><?php echo date(DATE_FORMAT, ($result->created_at));?></td>
                <td>
                    <?php 
                       /* $statusClass = Html::encode($result->status == ACTIVE) ? 'glyphicon glyphicon-ok' : 'glyphicon glyphicon-ban-circle';
                        $status = Html::encode($result->status == ACTIVE) ? 'Inactive' : 'Active';
                        echo Html::a('<span class="'.$statusClass.'"></span>', 'javascript:void(0)', ['class'=>'ableToChangeStatus', 'id'=>'ableToChangeStatus'.$result->id, 'url'=>Url::to([Yii::$app->controller->id."/status"]), 'title'=>'Make this user '.$status]);
                        * */
                    ?>
                    <?php //echo Html::a('<span class="glyphicon glyphicon-file"></span>', Url::to(['user/view', 'id'=>$result->id]), ['title'=>'View User Profile']);?>
                    <?php //echo Html::a('<span class="glyphicon glyphicon-edit"></span>', Url::to(['user/edit', 'id'=>$result->id]), ['title'=>'Edit User Details']);?>
                    <?php //echo Html::a('<span class="glyphicon glyphicon-remove-circle"></span>', 'javascript:void(0)', ['title'=>'Delete this User', 'class'=>'ableToDelete', 'id'=>'ableToDelete'.$result->id,  'url'=>Url::to([Yii::$app->controller->id."/delete"])]);?>
                    <?php /*if(Html::encode($result->email_verified) == NOT_VERIFIED) { 
                        echo Html::a('<span class="glyphicon glyphicon-exclamation-sign"></span>', 'javascript:void(0)', ['title'=>'Verify User Email', 'class'=>'ableToVerifyEmail', 'id'=>'ableToVerifyEmail'.$result->id]);
                    }*/?>
                    <?php //echo Html::a('<span class="glyphicon glyphicon-lock"></span>', Url::to(['user/change-user-password', 'id'=>$result->id]), ['title'=>'Change User\'s Password']);?>
                    <?php //echo Html::a('<span class="glyphicon glyphicon-lock"></span>', Url::to(['user/edit-permissions', 'id'=>$result->id]), ['title'=>'View User Permissions']);?>
                </td>
            </tr>
        <?php $i++;endforeach; ?>
      </tbody>
    </table>
    <div class="pull-right">
        <?php echo LinkPager::widget(['pagination'=>$pagination]);?>
    </div>    
    <?php } ?>
    
</div>



