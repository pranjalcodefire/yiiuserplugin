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
];
