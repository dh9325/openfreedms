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
//            'class' => 'app\common\components\WebUser',
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
            'class' => 'app\modules\user\Module'
        ],
        'admin'  => [
            'class' => 'app\modules\admin\Module'
        ],
        'install'  => [
            'class' => 'app\modules\install\Module'
        ]
    ]
];