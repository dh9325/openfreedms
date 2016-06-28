<?php

namespace app\modules\user\controllers;

class AuthController extends BaseUserController
{
    public function actionError()
    {
        return $this->render('error');
    }

    public function actionLogin()
    {
        return $this->render('login');
    }
}