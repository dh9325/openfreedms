<?php

namespace modules\admin\controllers;

use common\models\System;
use Yii;

class SystemController extends BaseAdminController
{
    public function actionUpdate()
    {
        $model = System::find()->one();
        if (Yii::$app->getRequest()->isPost) {
            $model->load(Yii::$app->getRequest()->post());
            if ($model->save()) {
                return $this->redirect('view');
            }
        }
        return $this->render('update', compact('model'));
    }

    public function actionView()
    {
        $model = System::find()->one();
        return $this->render('view', compact('model'));
    }

}
