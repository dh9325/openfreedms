<?php

namespace common\components\bootstrap;

class Dropdown extends \yii\bootstrap\Dropdown
{
    public function run()
    {
        BootstrapPluginAsset::register($this->getView());
        $this->registerClientEvents();
        return $this->renderItems($this->items, $this->options);
    }
}