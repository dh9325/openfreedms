<?php
/**
 * @var $model \app\modules\install\models\Configuration
 */
use \yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

$form = ActiveForm::begin();
?>
    <section>
        <div class="row">
            <div class="col-md-12">
                <h1><?= Yii::t('install', 'Database Configuration'); ?></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <?= $form->field($model, 'host', ['inputOptions' => ['disabled' => $model->isConfigured()]]); ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'databaseName', ['inputOptions' => ['disabled' => $model->isConfigured()]]); ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'username', ['inputOptions' => ['disabled' => $model->isConfigured()]]); ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'password', [
                    'inputOptions' => [
                        'disabled' => $model->isConfigured(),
                        'type' => 'password'
                    ]
                ]); ?>
            </div>
        </div>
    </section>
    <section>
        <div class="row">
            <div class="col-md-12">
                <h1><?= Yii::t('install', 'Master Admin'); ?></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-3"></div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?= Html::submitButton(Yii::t('install', 'Save'),
                    ['class' => 'btn btn-primary pull-right', 'disabled' => $model->isConfigured()]) ?>
            </div>
        </div>
    </section>

<?php
$form::end();