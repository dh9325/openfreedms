<?php

namespace modules\admin\controllers;

use common\components\System;
use Yii;
use yii\web\Controller;

class BaseAdminController extends Controller
{
    /**
     * @var $system System
     */
    protected $system;

    /**
     *
     */
    public function init()
    {
        parent::init();
        $this->system = Yii::$app->system;
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
}