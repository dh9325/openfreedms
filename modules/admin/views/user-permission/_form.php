<?php

use common\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UserPermission */
/* @var $form yii\widgets\ActiveForm */
?>

    <div class="user-permission-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'user')->dropDownList(
            ArrayHelper::map(User::findNonAdmins(true), 'id', 'username'),
            [
                'prompt' => Yii::t('app', 'Select'),
                'id' => 'js-user-dropdown'
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
$this->registerJsFile('/js/admin/user-permission.js', ['depends' => \yii\web\JqueryAsset::className()]);
