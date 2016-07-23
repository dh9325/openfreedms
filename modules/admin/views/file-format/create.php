<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\FileFormat */

$this->title = Yii::t('app', 'Create File Format');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'File Formats'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-format-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
