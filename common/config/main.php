<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
	'bootstrap' => ['log'], //'MyGlobalClass'],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager'=>[
            'class'=>'yii\rbac\DbManager',
			'defaultRoles' => ['guest']
        ],
        'urlManagerBackend' => [
            'class' => 'yii\web\urlManager',
            'baseUrl' => '/yump/yiiuserplugin/backend/web',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
        'urlManagerFrontend' => [
            'class' => 'yii\web\urlManager',
            'baseUrl' => '/yump/yiiuserplugin/frontend/web',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
//		'MyGlobalClass'=>[
//			'class'=>'common\components\MyGlobalClass'
//		],
    ],
    'on beforeAction'=>function ($event){
        //common\models\UserActivity::actionSave($event);
//		$permission = common\models\User::CheckPermission($event);
//		if(!$permission){
//			header('Location: http://localhost/yump-new/yiiuserplugin/backend/web/user/permission-denied');
//			exit;
//		}
    }
];
