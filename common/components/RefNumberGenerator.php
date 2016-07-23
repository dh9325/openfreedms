<?php

namespace common\components;

use yii\base\Component;

class RefNumberGenerator extends Component
{
    const PLACEHOLDER_DEPARTMENT_SYMBOL = '{{deptSymbol}}';
    const PLACEHOLDER_DOC_CATEGORY_SYMBOL = '{{docCatSymbol}}';

    const DEFAULT_TEMPLATE = self::PLACEHOLDER_DOC_CATEGORY_SYMBOL . '-' . self::PLACEHOLDER_DEPARTMENT_SYMBOL;

    public $template = self::DEFAULT_TEMPLATE;

    public static function generate($department, $documentCategory)
    {
        // todo: implement
    }

}