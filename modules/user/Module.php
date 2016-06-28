<?php

namespace app\modules\user;

class Module extends \yii\base\Module
{

    public $defaultRoute = 'auth/login';
    public $layoutPath = '@app/modules/user/views/layouts';
    public $layout = 'main';

    public function init()
    {
        parent::init();

        \Yii::$app->setHomeUrl('/user/dashboard');
        \Yii::$app->user->loginUrl = '/user/auth/login';
        \Yii::$app->errorHandler->errorAction = '/user/auth/error';
    }

}