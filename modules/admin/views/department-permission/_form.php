<?php

use common\models\Department;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\DepartmentPermission */
/* @var $form yii\widgets\ActiveForm */
?>

    <div class="department-permission-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'department')->dropDownList(
            ArrayHelper::map(Department::find()->all(), 'id', 'name'),
            [
                'prompt' => Yii::t('app', 'Select'),
                'id' => 'js-department-dropdown'
            ]) ?>

        <?= $form->field($model, 'document')->dropDownList([],
            [
                'prompt' => Yii::t('app', 'Select'),
                'id' => 'js-document-dropdown'
            ]) ?>

        <?= $form->field($model, 'type')->dropDownList($permissionTypes, ['prompt' => Yii::t('app', 'Select')]) ?>

        <div class="form-group">
            <?= Html::submitButton($this->context->action->id == 'create' ? Yii::t('app', 'Create') : Yii::t('app',
                'Update'),
                ['class' => $this->context->action->id == 'create' ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
<?php
$this->registerJsFile('/js/admin/department-permission.js', ['depends' => \yii\web\JqueryAsset::className()]);
