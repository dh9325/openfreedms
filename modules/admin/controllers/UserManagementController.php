<?php

namespace modules\admin\controllers;

use common\models\forms\AddUserForm;
use Yii;
use yii\web\UnauthorizedHttpException;

class UserManagementController extends BaseAdminController
{

    public function actionAdd()
    {
        if (!Yii::$app->user->identity->isMasterAdmin()) {
            throw new UnauthorizedHttpException();
        }
        $model = new AddUserForm();
        if (Yii::$app->getRequest()->isPost) {
            $model->load(Yii::$app->getRequest()->post());
            if ($this->system->addUser($model->username, $model->password, $model->email, $model->department)) {
                Yii::$app->getSession()->setFlash('success', Yii::t('app', 'User added successfully'));
            } else {
                Yii::$app->getSession()->setFlash('error', Yii::t('app', 'Could not add user'));
            }
        }
        return $this->render('add', compact('model'));
    }

    public function actionAddContributor()
    {
        return $this->render('add', []);
    }

    public function actionAddReviewer()
    {
        return $this->render('add', []);
    }

    public function actionAddApprover()
    {
        return $this->render('add', []);
    }
}