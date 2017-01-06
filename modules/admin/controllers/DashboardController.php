<?php

namespace modules\admin\controllers;

class DashboardController extends BaseAdminController
{
    public function actionIndex()
    {
        return $this->render('index', []);
    }
}