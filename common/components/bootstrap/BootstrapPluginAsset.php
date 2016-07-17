<?php

namespace common\components\bootstrap;

class BootstrapPluginAsset extends \yii\bootstrap\BootstrapPluginAsset
{
    public $sourcePath = '@bower/bootstrap/dist';
    public $js = [
        'js/bootstrap.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'common\components\bootstrap\BootstrapAsset',
    ];
}