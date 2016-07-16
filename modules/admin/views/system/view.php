<?php
/**
 * @var $this yii\web\View
 * @var $model \common\models\System
 */
use yii\bootstrap\Html;
use yii\widgets\DetailView;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'System'), 'url' => ['view']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="system-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'logo',
            'theme',
            'language',
            'authentication',
            'data_path',
            'revision_path',
        ],
    ]) ?>

</div>
