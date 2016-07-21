<?php

$db     = require(dirname(dirname(__DIR__)) . '/config/db.php');
$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'name' => 'Sme',
    // Need to get one level up:
    'basePath' => dirname(dirname(__DIR__)),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            'enableCookieValidation' => false,
            'enableCsrfValidation' => false,
            // Enable JSON Input:
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                    // Create API log in the standard log dir
                    // But in file 'api.log':
                    'logFile' => '@app/runtime/logs/api.log',
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => false,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'pluralize' => false,
                    'controller' => ['v1/event', 'v1/order', 'v1/tracking', 'v1/inventory'],
                    // 'patterns' => ['PUT,PATCH {id}' => 'update', 'DELETE {id}' => 'delete', 'GET,HEAD {id}' => 'view', 'POST' => 'create', 'GET,HEAD' => 'index', '{id}' => 'options', '' => 'options'],
                    'extraPatterns' => [
                        'POST push' => 'push',//todob this is tracking push
                    ],
                    'tokens' => [
                        '{page}' => '<page:\\d+>',
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'pluralize' => false,
                    'controller' => 'v1/order',
                    'extraPatterns' => [
                        'POST pull' => 'pull',
                        'POST acknowledge' => 'acknowledge',
                        'GET pull' => 'pull', // 'confirm' refers to 'actionConfirm'
                    ],
                ],
                // [
                //     '<controller:(catalog|inventory|order)>_<action:(pull)>_v1' => 'v1/<controller>/<action>',
                //     // 'posts' => 'post/index',
                //     // 'post/<id:\d+>' => 'post/view',
                // ]
            ]
        ],
        'db' => $db,
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],

    ],
    'modules' => [
        'v1' => [
            'class' => 'app\api\modules\v1\Module',
            'basePath' => '@app/api/modules/v1',
        ],
    ],
    'params' => $params,
];

return $config;
