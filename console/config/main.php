<?php
/* 123456 */
$params = require(__DIR__ . '/../../common/config/params-local.php');

$mainConfig = require(__DIR__ . '/../../common/config/main-local.php');
$db = [];
if(isset($mainConfig['components']) && isset($mainConfig['components']['db']))
    $db = $mainConfig['components']['db'];

$config = [
    'id' => 'app-console',
    'basePath' => dirname(__DIR__ ),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'console\controllers',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'baseUrl' => 'https://hrm.thgroup.io/',
            'scriptUrl' => 'https://hrm.thgroup.io/'
        ]
    ],
    'params' => $params,
    /*
    'controllerMap' => [
        'fixture' => [ // Fixture generation command line.
            'class' => 'yii\faker\FixtureController',
        ],
    ],
    */
];

return $config;