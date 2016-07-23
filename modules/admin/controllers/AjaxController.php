<?php

namespace modules\admin\controllers;

use common\models\Document;
use yii\helpers\ArrayHelper;

class AjaxController extends BaseAdminController
{
    public $layout = false;

    public function actionNoDeptPermDocs($deptId)
    {
        $docs = ArrayHelper::map(Document::findNoDepartmentPermissions($deptId), 'id', 'title');
        return $this->render('no-dept-perm-docs', compact('docs'));
    }

    public function actionNoUserPermDocs($userId)
    {
        $docs = ArrayHelper::map(Document::findNoUserPermissions($userId), 'id', 'title');
        return $this->render('no-user-perm-docs', compact('docs'));
    }
}