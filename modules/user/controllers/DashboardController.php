<?php

namespace modules\user\controllers;

class DashboardController extends BaseUserController
{
    public function actionIndex()
    {
        return $this->render('index', []);
    }

}