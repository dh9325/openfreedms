<?php

namespace common\components\bootstrap;

use yii\helpers\ArrayHelper;

class Nav extends \yii\bootstrap\Nav
{
    public function run()
    {
        BootstrapAsset::register($this->getView());
        return $this->renderItems();
    }

    protected function renderDropdown($items, $parentItem)
    {
        return Dropdown::widget([
            'options' => ArrayHelper::getValue($parentItem, 'dropDownOptions', []),
            'items' => $items,
            'encodeLabels' => $this->encodeLabels,
            'clientOptions' => false,
            'view' => $this->getView(),
        ]);
    }
}