<?php

namespace common\assets;

use common\models\System;
use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [];
    public $js = [];
    public $depends = [
        'yii\web\YiiAsset'
    ];

    public function init()
    {
        $theme = System::getTheme();
        if (!$theme) {
            $this->depends[] = 'yii\bootstrap\BootstrapAsset';
        } else {
            $theme = strtolower($theme);
            $this->css[] = "css/themes/{$theme}.min.css";
        }
        $this->css[] = 'css/site.css';
        parent::init();
    }
}
