<?php

use common\models\System;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\System */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="system-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(); ?>

    <?= $form->field($model, 'logo')->fileInput([]); ?>

    <?= $form->field($model, 'theme')->dropDownList(System::$themes, ['prompt' => Yii::t('app', 'Select')]); ?>

    <?= $form->field($model, 'language')->dropDownList([], ['prompt' => Yii::t('app', 'Select')]); ?>

    <?= $form->field($model, 'authentication')->dropDownList([], ['prompt' => Yii::t('app', 'Select')]); ?>

    <?= $form->field($model, 'data_path')->textInput(); ?>

    <?= $form->field($model, 'revision_path')->textInput(); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Update'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
