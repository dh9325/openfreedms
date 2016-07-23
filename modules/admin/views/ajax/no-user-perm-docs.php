<?php
/**
 * @var $docs
 */
use yii\bootstrap\Html;

echo Html::dropDownList('', null, $docs, ['prompt' => Yii::t('app', 'Select')]);