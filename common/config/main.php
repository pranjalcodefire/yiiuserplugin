<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
	'bootstrap' => ['log','MyGlobalClass'],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager'=>[
            'class'=>'yii\rbac\DbManager',
        ],
		'MyGlobalClass'=>[
			'class'=>'common\components\MyGlobalClass'
		],
    ],
    'on beforeAction'=>function ($event){
		$permission = common\models\User::CheckPermission($event);
		if(!$permission){
			header('Location: http://localhost/yump-new/yiiuserplugin/backend/web/user/permission-denied');
			exit;
		}
    }
];
