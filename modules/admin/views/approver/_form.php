<?php

use common\models\Department;
use common\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Approver */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="approver-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user')->dropDownList(ArrayHelper::map(User::findAllActive(), 'id', 'username'),
        ['prompt' => Yii::t('app', 'Select')]) ?>

    <?= $form->field($model, 'department')->dropDownList(ArrayHelper::map(Department::findAllActive(), 'id', 'name'),
        ['prompt' => Yii::t('app', 'Select')]) ?>

    <div class="form-group">
        <?= Html::submitButton($this->context->action->id == 'create' ? Yii::t('app', 'Create') : Yii::t('app',
            'Update'),
            ['class' => $this->context->action->id == 'create' ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
