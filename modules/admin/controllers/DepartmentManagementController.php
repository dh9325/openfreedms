<?php

namespace modules\admin\controllers;

class DepartmentManagementController extends BaseAdminController
{
    public function actionAdd()
    {
        return $this->render('add', []);
    }
}