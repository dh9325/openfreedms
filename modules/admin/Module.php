<?php

namespace modules\admin;

use common\models\System;

class Module extends \yii\base\Module
{

    public $defaultRoute = 'auth/login';
    public $layoutPath = '@app/modules/admin/views/layouts';
    public $layout = 'main';

    public function init()
    {
        parent::init();

        \Yii::$app->setHomeUrl('/admin/dashboard');
        \Yii::$app->user->loginUrl = '/user/auth/login';
        \Yii::$app->errorHandler->errorAction = '/user/auth/error';
        \Yii::$app->language = System::getLanguage();
    }

}