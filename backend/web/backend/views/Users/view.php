<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'first_name',
            'last_name',
            'email:email',
            'username',
            'password',
            'auth_key',
            'password_hash',
            'password_reset_token',
            'user_group_id',
            'role',
            'fb_id',
            'fb_access_token:ntext',
            'twt_id',
            'twt_access_token:ntext',
            'twt_access_secret:ntext',
            'ldn_id',
            'status',
            'email_verified:email',
            'last_login',
            'by_admin',
            'created:ntext',
            'modified:ntext',
        ],
    ]) ?>

</div>
