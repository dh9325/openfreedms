<?php

namespace common\components\bootstrap;

use common\models\System;
use Yii;

class BootstrapAsset extends \yii\bootstrap\BootstrapAsset
{
    public $sourcePath = '@bower/bootstrap/dist';
    public $css = [];

    public function init()
    {
        $theme = System::getTheme();
        if (!$theme) {
            $this->css[] = 'css/bootstrap.min.css';
        } else {
            $theme = strtolower($theme);
            $this->css[] = Yii::getAlias("@web/css/themes/{$theme}.min.css");
        }
        parent::init();
    }
}