<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        //'online'=>[
        //    'class'=>'common\components\Online',
        //],
        'authManager'=>[
            'class'=>'yii\rbac\DbManager',
        ],
    ],
];
