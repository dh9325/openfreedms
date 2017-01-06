<?php

use common\models\Department;
use common\models\DocumentCategory;
use common\models\Workflow;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\Document */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="document-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'file')->widget(FileInput::className(), [
        'pluginOptions' => [
            'showPreview' => false,
            'showCaption' => true,
            'showRemove' => true,
            'showUpload' => false
        ]
    ]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'referenceNumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'documentCategory')->dropDownList(ArrayHelper::map(DocumentCategory::find()->all(), 'id',
        'name'), ['prompt' => Yii::t('app', 'Select')]) ?>

    <?= $form->field($model, 'department')->dropDownList(ArrayHelper::map(Department::find()->all(), 'id', 'name'),
        ['prompt' => Yii::t('app', 'Select')]) ?>

    <?= $form->field($model, 'workflow')->dropDownList(Workflow::$workflows, ['prompt' => Yii::t('app', 'Select')]) ?>

    <div class="form-group">
        <?= Html::submitButton($this->context->action->id == 'create' ? Yii::t('app', 'Create') : Yii::t('app',
            'Update'),
            ['class' => $this->context->action->id == 'create' ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
