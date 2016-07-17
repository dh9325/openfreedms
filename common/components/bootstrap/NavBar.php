<?php

namespace common\components\bootstrap;

use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;

class NavBar extends \yii\bootstrap\NavBar
{
    /**
     * Renders the widget.
     */
    public function run()
    {
        $tag = ArrayHelper::remove($this->containerOptions, 'tag', 'div');
        echo Html::endTag($tag);
        if ($this->renderInnerContainer) {
            echo Html::endTag('div');
        }
        $tag = ArrayHelper::remove($this->options, 'tag', 'nav');
        echo Html::endTag($tag);
        BootstrapPluginAsset::register($this->getView());
    }
}