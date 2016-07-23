<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\DepartmentPermission */

$this->title = Yii::t('app', 'Create Department Permission');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Department Permissions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="department-permission-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', compact('model', 'permissionTypes')) ?>

</div>
