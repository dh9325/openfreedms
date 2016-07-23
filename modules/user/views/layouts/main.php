<?php

/* @var $this \yii\web\View */
/* @var $content string */

use common\assets\AppAsset;
use common\models\System;
use yii\helpers\Html;
use common\components\bootstrap\Nav;
use common\components\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

$name = System::find()->one()->name;

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
        'brandLabel' => $name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => Yii::t('app', 'Login'), 'url' => ['/user/auth/login']];
    } else {
        $menuItems[] = ['label' => Yii::t('app', 'Home'), 'url' => ['/user/dashboard']];
        if (Yii::$app->user->getIdentity()->isApprover() || Yii::$app->user->getIdentity()->isAdmin()) {
            $menuItems[] = [
                'label' => Yii::t('app', 'Approver'),
                'items' => [
                    [
                        'label' => Yii::t('app', 'Approve Documents'),
                        'url' => '/admin/document/approve'
                    ]
                ]
            ];
        }
        if (Yii::$app->user->getIdentity()->isContributor() || Yii::$app->user->getIdentity()->isAdmin()) {
            $menuItems[] = [
                'label' => Yii::t('app', 'Contributor'),
                'items' => [
                    [
                        'label' => Yii::t('app', 'Add Document'),
                        'url' => '/admin/document/create'
                    ],
                    [
                        'label' => Yii::t('app', 'Manage Department Permissions'),
                        'url' => '/admin/department-permission/'
                    ],
                    [
                        'label' => Yii::t('app', 'Manage User Permissions'),
                        'url' => '/admin/user-permission/'
                    ]
                ]
            ];
        }
        if (Yii::$app->user->getIdentity()->isReviewer() || Yii::$app->user->getIdentity()->isAdmin()) {
            $menuItems[] = [
                'label' => Yii::t('app', 'Reviewer'),
                'items' => [
                    [
                        'label' => Yii::t('app', 'Review Documents'),
                        'url' => '/admin/document/review'
                    ]
                ]
            ];
        }
        if (Yii::$app->user->getIdentity()->isMasterAdmin()) {
            $adminItems = [
                '<li class="divider"></li>',
                [
                    'label' => Yii::t('app', 'System Management'),
                    'url' => '/admin/system/view'
                ],
                [
                    'label' => Yii::t('app', 'File Format Management'),
                    'url' => '/admin/file-format/view'
                ],
            ];
        }
        if (Yii::$app->user->getIdentity()->isAdmin()) {
            $menuItems[] = [
                'label' => Yii::t('app', 'Admin'),
                'items' => \yii\helpers\ArrayHelper::merge([
                    [
                        'label' => Yii::t('app', 'Approver Management'),
                        'url' => '/admin/approver/'
                    ],
                    [
                        'label' => Yii::t('app', 'Contributor Management'),
                        'url' => '/admin/contributor/'
                    ],
                    [
                        'label' => Yii::t('app', 'Department Management'),
                        'url' => '/admin/department/'
                    ],
                    [
                        'label' => Yii::t('app', 'Document Category Management'),
                        'url' => '/admin/document-category/'
                    ],
                    [
                        'label' => Yii::t('app', 'Reviewer Management'),
                        'url' => '/admin/reviewer/'
                    ],
                    [
                        'label' => Yii::t('app', 'User Management'),
                        'url' => '/admin/user/'
                    ]
                ], $adminItems)
            ];
        }

        $menuItems[] = '<li>'
            . Html::beginForm(['/auth/logout'], 'post')
            . Html::submitButton(Yii::t('app', 'Logout') .
                ' (' . Yii::$app->user->getIdentity()->username . ')',
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
        <p class="pull-left">&copy; <?= $name ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
