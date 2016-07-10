<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use modules\admin\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Open Free DMS',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/user/dashboard']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/user/auth/login']];
    } else {
        if (Yii::$app->user->identity->isMasterAdmin() || Yii::$app->user->identity->isAdmin()) {
            if (Yii::$app->user->identity->isMasterAdmin()) {
                $masterAdminItems = [
                    '<li class="divider"></li>',
                    ['label' => Yii::t('app', 'Add User'), 'url' => '/admin/user-management/add']
                ];
            }
            $menuItems[] = [
                'label' => Yii::t('app', 'Admin'),
                'url' => '/admin/dashboard',
                'items' => ArrayHelper::merge([
                    ['label' => Yii::t('app', 'Add Department'), 'url' => '/admin/department-management/add'],
                    [
                        'label' => Yii::t('app', 'Add Document Category'),
                        'url' => '/admin/document-management/add-document-category'
                    ],
                    ['label' => Yii::t('app', 'Add Contributor'), 'url' => '/admin/user-management/add-contributor'],
                    ['label' => Yii::t('app', 'Add Reviewer'), 'url' => '/admin/user-management/add-reviewer'],
                    ['label' => Yii::t('app', 'Add Approver'), 'url' => '/admin/user-management/add-approver'],
                ], $masterAdminItems)
            ];
        }

        $menuItems[] = '<li>'
            . Html::beginForm(['/auth/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Open Free DMS <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
