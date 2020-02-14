<?php
require_once(__DIR__.'/functions.php');
return [
    'language' => 'ru-RU',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager'
        ],
        'user' => [
            'identityClass' => 'mdm\admin\models\User',
            'loginUrl' => ['site/login'],
        ]
    ],
    'modules' => [
        'admin' => [
            'class' => 'mdm\admin\Module',
        ]
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'site/*',
//            '/*'
        ]
    ],
    'on beforeRequest' => function () {
        $debug = \Yii::$app->getModule('debug');
        \Yii::$app->has('user', true) ? Yii::$app->get('user') : null;
        if(\Yii::$app->has('user', true)){
            //12 - это id пользователя
            $debug->allowedIPs = Yii::$app->user->id === 1 ? ['*'] : [''];

        }
    },
    'controllerMap' => [
        'elfinder' => [
            'class' => 'mihaildev\elfinder\PathController',
            'root' => [
                'baseUrl' => '@site',
                'basePath' => '@frontend/web/',
                'path' => 'uploads/',
                'name' => 'Uploads'
            ],
        ]
    ],
];
