<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\Document */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Documents');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="document-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php if (Yii::$app->getUser()->getIdentity()->isContributor()): ?>
            <?= Html::a(Yii::t('app', 'Create Document'), ['create'], ['class' => 'btn btn-success']) ?>
        <?php endif; ?>
    </p>

    <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'title',
            'reference_number',
            'revision_number',
            [
                'class' => 'yii\grid\ActionColumn',
                'visibleButtons' => [
                    'view' => function ($model, $key, $index) {
                        return Yii::$app->getUser()->getIdentity()->canView($model);
                    },
                    'update' => function ($model, $key, $index) {
                        return Yii::$app->getUser()->getIdentity()->canEdit($model);
                    },
                    'delete' => function ($model, $key, $index) {
                        return Yii::$app->getUser()->getIdentity()->canAdmin($model);
                    },
                ]
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?></div>
