<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'name' => 'TAXI',
    'language' => 'ru-RU',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'gridview' =>  [
            'class' => '\kartik\grid\Module',
        ],
        'driver' => [
            'class' => 'backend\modules\driver\Driver',
        ],
        'passenger' => [
            'class' => 'backend\modules\passenger\Passenger',
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
            'baseUrl' => '/personal',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-cookie', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'session-name',
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
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'site/index',
                '<controller:\w+>/<action:\w+>/' => '<controller>/<action>',
            ],
        ],
        'formatter' => [
            'class'             => 'yii\i18n\Formatter',
            'locale'            => 'ru-RU',
            'dateFormat'        => 'php:d.m.Y',
            'datetimeFormat'    => 'php:d.m.Y H:i',
            'timeFormat'        => 'php:H:i',
        ],
        'assetManager' => [
            'appendTimestamp' => true,
            'bundles' => [
                'wbraganca\dynamicform\DynamicFormAsset' => [
                    'sourcePath' => '@app/web/js',
                    'js' => [
                        'yii2-dynamic-form.js'
                    ],
                ],
            ]
        ],
    ],
    'params' => $params,
];
