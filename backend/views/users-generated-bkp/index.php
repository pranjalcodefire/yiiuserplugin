<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'User',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'first_name',
            'last_name',
            'email:email',
            'username',
            // 'password',
            // 'auth_key',
            // 'password_hash',
            // 'password_reset_token',
            // 'user_group_id',
            // 'role',
            // 'fb_id',
            // 'fb_access_token:ntext',
            // 'twt_id',
            // 'twt_access_token:ntext',
            // 'twt_access_secret:ntext',
            // 'ldn_id',
            // 'status',
            // 'email_verified:email',
            // 'last_login',
            // 'by_admin',
            // 'created:ntext',
            // 'modified:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
