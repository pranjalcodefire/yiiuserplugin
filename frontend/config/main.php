<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'db'=>[
            'class'=>'yii\db\Connection',
            'dsn'=>'mysql:host=localhost;dbname=yiiplugin',
            'username'=>'root',
            'password'=>'',
            'charset'=>'utf8'
        ],
        'urlManager'=>[
            'showScriptName'=>false,
            'enablePrettyUrl'=>true,
            'enableStrictParsing'=>false,
            'rules'=>[
                [
                    'pattern'=>'<controller:\w+>/<action:\w+>',
                    'route'=>'<controller>/<action>',
                ]
            ],
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'params' => $params,
];
