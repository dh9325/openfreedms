<?php

namespace modules\install;

use common\models\System;

class Module extends \yii\base\Module
{

    public $defaultRoute = 'config/index';
    public $layoutPath = '@app/modules/install/views/layouts';
    public $layout = 'main';

    public function init()
    {
        parent::init();

        \Yii::$app->setHomeUrl('/config/index');
        \Yii::$app->user->loginUrl = '/user/auth/login';
        \Yii::$app->errorHandler->errorAction = '/user/dashboard/error';
        \Yii::$app->language = System::getLanguage();

        \Yii::configure($this, [
            'components' => [
                'db' => null
            ]
        ]);
    }

}