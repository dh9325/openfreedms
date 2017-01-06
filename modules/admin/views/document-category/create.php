<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\DocumentCategory */

$this->title = Yii::t('app', 'Create Document Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Document Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="document-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
