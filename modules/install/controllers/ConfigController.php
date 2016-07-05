<?php

namespace app\modules\install\controllers;

use app\modules\install\models\Configuration;
use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;

/**
 * Site controller
 */
class ConfigController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'error'],
                        'allow' => true,
                    ]
                ],
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays configuration page.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = Configuration::get();
        if (Yii::$app->request->isPost) {
            // replace placeholders with new settings
            $model->load(Yii::$app->request->post());
            $model->saveConfiguration();
        }
        return $this->render('index', compact('model'));
    }
}
