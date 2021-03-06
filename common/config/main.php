<?php
return [
    'id' => 'OpenFreeDMS',
    'defaultRoute' => 'user/',
    'controllerNamespace' => 'modules\\user\\controllers',
    'basePath' => dirname(dirname(__DIR__)),
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource'
                ],
            ],
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'system' => [
            'class' => 'common\components\System'
        ]
    ],
    'bootstrap' => ['log'],
];
