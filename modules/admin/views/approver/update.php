<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Approver */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Approver',
]) . $model->user_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Approvers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user_id, 'url' => ['view', 'user_id' => $model->user_id, 'department_id' => $model->department_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="approver-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
