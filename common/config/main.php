<?php
return [
    'id' => 'OpenFreeDMS',
    'defaultRoute' => 'user/',
    'controllerNamespace' => 'app\\modules\\user\\controllers',
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
    ],
    'bootstrap' => ['log'],
];
