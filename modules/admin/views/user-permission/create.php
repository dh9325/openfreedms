<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\UserPermission */

$this->title = Yii::t('app', 'Create User Permission');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Permissions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-permission-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', compact('model', 'permissionTypes')) ?>

</div>
