<?php 
use yii\helpers\Url;
use yii\helpers\Html;
?>
<style>
    a.thumbnail:hover, a.thumbnail:focus, a.thumbnail.active{
        background-color: rgb(232, 233, 237);
        padding-left:5%;
        transition-duration: 2s;
    }
</style>
<span>Hi <?php echo Html::encode($model->first_name); ?></span></span>
<div class="row">
    
    <div class=" col-md-2">
        <a href="<?php echo Url::to(['user/my-profile']);?>" class="thumbnail" title='My Profile'>
            My Profile
            <!--<img alt="100%x180" src="<?php echo Yii::$app->homeUrl; ?>/plugin-images/profile.jpg" class="dashboard-thumbnails">-->
      </a>
    </div>
    <div class="col-md-2">
        <a href="<?php echo Url::to(['user/edit-profile']);?>" class="thumbnail" title='Edit Profile'>
          Edit Profile<!--<img alt="100%x180" src="<?php echo Yii::$app->homeUrl;?>/plugin-images/all-users.jpg" class="dashboard-thumbnails">-->
      </a>
    </div>
    <div class=" col-md-2">
      <a href="<?php echo Url::to(['user/change-password']);?>" class="thumbnail" title='Change Password'>
          Change Password<!--<img alt="100%x180" src="<?php echo Yii::$app->homeUrl; ?>/plugin-images/add-user.jpg" class="dashboard-thumbnails">-->
      </a>
    </div>
</div>


