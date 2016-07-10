<?php

/**
 * @var $model \common\models\User
 */
use common\models\Department;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;

$form = ActiveForm::begin();
?>
    <div class="row">
        <div class="col-md-3"><?= $form->field($model, 'username', []); ?></div>
        <div class="col-md-3"><?= $form->field($model, 'email', []); ?></div>
        <div class="col-md-3"><?= $form->field($model, 'password', []); ?></div>
        <div class="col-md-3"><?= $form->field($model, 'department', [])
                ->dropDownList(ArrayHelper::map(Department::findAllActive(), 'id', 'name'), [
                    'prompt' => Yii::t('app', 'Select Department')
                ]); ?></div>
    </div>
    <div class="row">
        <div class="col-md-3"><?= $form->field($model, 'isAdmin', [])->checkbox([]); ?></div>
        <div class="col-md-3"><?= $form->field($model, 'isMasterAdmin', [])->checkbox([]); ?></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary pull-right']); ?>
        </div>
    </div>
<?php
$form::end();

