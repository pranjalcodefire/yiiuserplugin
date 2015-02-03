<?php 
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'Dashboard';
?>
<style>
    a.thumbnail:hover, a.thumbnail:focus, a.thumbnail.active{
        background-color: rgb(232, 233, 237);
    }
</style>
<span>Hi <?php echo Html::encode($model->username); ?></span>
<div class="row">
    
    <div class=" col-md-2">
        <a href="<?php echo Url::to(['user/my-profile']);?>" class="thumbnail" title='My Profile'>
          <img alt="100%x180" src="<?php echo Yii::$app->homeUrl; ?>/plugin-images/profile.jpg" class="dashboard-thumbnails">
      </a>
    </div>
    <div class="col-md-2">
        <a href="<?php echo Url::to(['user/index']);?>" class="thumbnail" title='All Users'>
          <img alt="100%x180" src="<?php echo Yii::$app->homeUrl;?>/plugin-images/all-users.jpg" class="dashboard-thumbnails">
      </a>
    </div>
    <div class=" col-md-2">
      <a href="<?php echo Url::to(['user/save']);?>" class="thumbnail" title='Add User'>
          <img alt="100%x180" src="<?php echo Yii::$app->homeUrl; ?>/plugin-images/add-user.jpg" class="dashboard-thumbnails">
      </a>
    </div>
    <div class=" col-md-2">
      <a href="<?php echo Url::to(['user-group/save']);?>" class="thumbnail" title='All Groups'>
          <img alt="100%x180" src="<?php echo Yii::$app->homeUrl; ?>/plugin-images/add-user.jpg" class="dashboard-thumbnails">
      </a>
    </div>
    <div class=" col-md-2">
      <a href="<?php echo Url::to(['user-group/save']);?>" class="thumbnail" title='Add Group'>
          <img alt="100%x180" src="<?php echo Yii::$app->homeUrl; ?>/plugin-images/add-user.jpg" class="dashboard-thumbnails">
      </a>
    </div>
    <div class=" col-md-2">
      <a href="<?php echo Url::to(['setting/index']);?>" class="thumbnail" title='Settings'>
          <img alt="100%x180" src="<?php echo Yii::$app->homeUrl; ?>/plugin-images/add-user.jpg" class="dashboard-thumbnails">
      </a>
    </div>
    
</div>


