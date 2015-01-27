<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
?>
<div class="col-md-12">
    <h4>All Users</h4><hr>
    <?php if(!empty($results)) { $i = (intval($pagination->offset) + 1);?>
    <table class="table table-hover table-bordered">
      <thead>
        <tr>
          <th>#</th>
          <th>User ID</th>
          <th>Username</th>
          <th>Email</th>
          <th>Group(s)</th>
          <th>Email Verified</th>
          <th>Status</th>
          <th>Created</th>
          <th>Email Verified</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($results as $result): ?>
            <tr class="<?php echo ($result->status == ACTIVE) ? 'success' : 'danger'; ?>">
                <th scope="row"><?php echo $i; ?></th>
                <td><?php echo Html::encode($result->id);?></td>
                <td><?php echo Html::encode($result->username);?></td>
                <td><?php echo Html::encode($result->email);?></td>
                <td><?php echo Html::encode($result->username);?></td>
                <td><?php echo Html::encode($result->username);?></td>
                <td><?php echo (Html::encode($result->status) == ACTIVE) ? 'Active' : 'Inactive';?></td>
                <td><?php echo (date('d-M-Y',Html::encode($result->created)));?></td>
                <td><?php echo Html::encode($result->username);?></td>
                <td>
                    <a href="<?php echo  Url::to(['user/status', 'id'=>1]); ?>" title="<?php echo Html::encode($result->status == ACTIVE) ? "Make Inactive" : "Make Active";?>"><span class="<?php echo (Html::encode($result->status == ACTIVE) ? "glyphicon glyphicon-ok-circle" : "glyphicon glyphicon-ban-circle"); ?>"></span></a>
                    <a href="<?php echo Url::to(['user/view', 'id'=>1]); ?>" title="View User Profile"><span class="glyphicon glyphicon-zoom-in"></span></a>
                    <a href="<?php echo Url::to(['user/save', 'id'=>1]); ?>" title="Edit User Details"><span class="glyphicon glyphicon-edit"></span></a>
                    <a href="<?php echo Url::to(['user/delete', 'id'=>1]); ?>" title="Delete this User"><span class="glyphicon glyphicon-remove-circle"></span></a>
                    <a href="<?php echo Url::to(['user/verifyEmail', 'id'=>1]); ?>" title="Verify User Email"><span class="glyphicon glyphicon-star"></span></a>
                    <a href="<?php echo Url::to(['user/changePassword', 'id'=>1]); ?>" title="Change User's Password"><span class="glyphicon glyphicon-star"></span></a>
                    <a href="<?php echo Url::to(['user/editPermissions', 'id'=>1]); ?>" title="View User Permissions"><span class="glyphicon glyphicon-star"</span></a>

                </td>
            </tr>
        <?php $i++;endforeach; ?>
      </tbody>
    </table>
    <?php echo LinkPager::widget(['pagination'=>$pagination]);?>
    <?php } ?>
    
</div>



