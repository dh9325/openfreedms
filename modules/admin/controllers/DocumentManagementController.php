<?php

namespace modules\admin\controllers;

class DocumentManagementController extends BaseAdminController
{
    public function actionAddDocumentCategory()
    {
        return $this->render('add-document-category', []);
    }
}