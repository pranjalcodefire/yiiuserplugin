<?php 
use yii\helpers\Url;
use yii\helpers\Html;
use frontend\widgets\Alert;

$this->title = 'Dashboard';
?>
<style>
    a.thumbnail:hover, a.thumbnail:focus, a.thumbnail.active{
        background-color: rgb(232, 233, 237);
    }
</style>
<span>Hi <?php echo Html::encode($model->username); ?></span>
<div class="row">
    <div class=" col-md-12">
        <?php echo Alert::widget();?>
    </div>
</div>
<div class="row">
    <div class=" col-md-2">
        <a href="<?php echo Url::to(['user/my-profile']);?>" class="thumbnail" title='My Profile'>
          <img alt="100%x180" src="<?php echo Yii::$app->homeUrl; ?>/plugin-images/profile.jpg" class="dashboard-thumbnails">
          <div class="caption text-center">
            <h5>My Profile</h5>
          </div>
      </a>
    </div>
    <div class="col-md-2">
        <a href="<?php echo Url::to(['user/index']);?>" class="thumbnail" title='All Users'>
          <img alt="100%x180" src="<?php echo Yii::$app->homeUrl;?>/plugin-images/all-users.jpg" class="dashboard-thumbnails">
          <div class="caption text-center">
            <h5>All Users</h5>
          </div>
      </a>
    </div>
    <div class=" col-md-2">
      <a href="<?php echo Url::to(['user/save']);?>" class="thumbnail" title='Add User'>
          <img alt="100%x180" src="<?php echo Yii::$app->homeUrl; ?>/plugin-images/add-user.jpg" class="dashboard-thumbnails">
          <div class="caption text-center">
            <h5>Add User</h5>
          </div>
      </a>
    </div>
    <div class=" col-md-2">
      <a href="<?php echo Url::to(['user-group/save']);?>" class="thumbnail" title='All Groups'>
          <img alt="100%x180" src="<?php echo Yii::$app->homeUrl; ?>/plugin-images/add-user.jpg" class="dashboard-thumbnails">
          <div class="caption text-center">
            <h5>Add Group</h5>
          </div>
      </a>
    </div>
    <div class=" col-md-2">
      <a href="<?php echo Url::to(['user-group/index']);?>" class="thumbnail" title='Add Group'>
          <img alt="100%x180" src="<?php echo Yii::$app->homeUrl; ?>/plugin-images/add-user.jpg" class="dashboard-thumbnails">
          <div class="caption text-center">
            <h5>All Groups</h5>
          </div>
      </a>
    </div>
    <div class=" col-md-2">
      <a href="<?php echo Url::to(['setting/index']);?>" class="thumbnail" title='Settings'>
          <img alt="100%x180" src="<?php echo Yii::$app->homeUrl; ?>/plugin-images/add-user.jpg" class="dashboard-thumbnails">
          <div class="caption text-center">
            <h5>Settings</h5>
          </div>
      </a>
    </div>
</div>
<div class="row">
    <div class=" col-md-2">
        <a href="<?php echo Url::to(['user/clear-cache']);?>" class="thumbnail" title='Flush Cache'>
            <img alt="100%x180" src="<?php echo Yii::$app->homeUrl; ?>/plugin-images/add-user.jpg" class="dashboard-thumbnails">
            <div class="caption text-center">
              <h5>Flush Cache</h5>
            </div>
        </a>
    </div>
    <div class=" col-md-2">
        <a href="<?php echo Url::to(['user/online']);?>" class="thumbnail" title='Online Users'>
            <img alt="100%x180" src="<?php echo Yii::$app->homeUrl; ?>/plugin-images/add-user.jpg" class="dashboard-thumbnails">
            <div class="caption text-center">
              <h5>Online Users</h5>
            </div>
        </a>
    </div>
</div>