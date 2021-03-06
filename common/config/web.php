<?php
return [
    'components'          => [
        'errorHandler' => [
            'errorAction' => 'user/auth/error',
        ],
//        'authManager' => [
//            'class' => 'common\components\RbacManager',
//            'itemFile' => '@bin/rbac/item.php',
//            'assignmentFile' => '@bin/rbac/assignments.php'
//        ],
        'request'    => [
            'enableCookieValidation' => true,
            'enableCsrfValidation'   => true,
            'cookieValidationKey'    => 'xxxxxxx',
        ],
        'user'       => [
            'identityClass'   => 'common\models\User',
            'enableAutoLogin' => true,
            'returnUrl' => '/user/dashboard'
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName'  => false,
            'rules'           => require(__DIR__ . '/routes.php')

        ],
    ],
    'modules'             => [
        'debug' => [
            'class'      => 'yii\debug\Module',
            'allowedIPs' => ['*']
        ],
        'user'  => [
            'class' => 'modules\user\Module'
        ],
        'admin'  => [
            'class' => 'modules\admin\Module'
        ],
        'install'  => [
            'class' => 'modules\install\Module'
        ]
    ]
];