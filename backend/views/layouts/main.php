<?php

/**
 * Theme main layout.
 *
 * @var \yii\web\View $this View
 * @var string $content Content
 */

use backend\widgets\Alert;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;

/** @var \backend\models\User $userIdentity */
$userIdentity = Yii::$app->user->identity;

//Url::remember();
?>
<?php $this->beginPage(); ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <?= $this->render('head') ?>
    </head>
    <body class="sidebar-mini skin-green <?= (array_key_exists('sidebar-collapse', $this->params) && 'sidebar-collapse'); ?>">
    <?php $this->beginBody(); ?>

    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="<?= Yii::$app->homeUrl ?>" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini">
                        <?= Yii::t('admin', 'CN') ?>
                    </span>
                <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg">
                        <?= Yii::$app->name ?>
                    </span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only"><?= Yii::t('admin', 'Toggle navigation') ?></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <?php if (!Yii::$app->user->isGuest): ?>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <span class="hidden-xs"><?= $userIdentity->username ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <!--<li class="user-header">

                                </li>-->
                                <!-- Menu Body -->
                                <li class="user-body text-center">
                                    <p>
                                        <?= Yii::t('admin', 'Username') ?>: <strong><?= $userIdentity->username ?></strong><br>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                    </div>
                                    <div class="pull-right">
                                        <?= Html::a(
                                            Yii::t('admin', 'Sign out'),
                                            ['/site/logout'],
                                            ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                        ) ?>
                                    </div>
                                </li>
                            </ul>
                            <?php endif; ?>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <?= $this->render('sidebar-menu') ?>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    <?= $this->title ?>
                    <?php if (isset($this->params['subtitle'])) : ?>
                        <small><?= $this->params['subtitle'] ?></small>
                    <?php endif; ?>
                </h1>
                <?= Breadcrumbs::widget(
                    [
                        'homeLink' => [
                            'label' => '<i class="fa fa-dashboard"></i> ' . Yii::t('admin', 'Home'),
                            'url' => '/'
                        ],
                        'encodeLabels' => false,
                        'tag' => 'ol',
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : []
                    ]
                ) ?>
            </section>
            <!-- Main content -->
            <section class="content">
                <?= Alert::widget(); ?>
                <?= $content ?>
            </section><!-- /.content -->
            <!-- /.content -->
        </div>

        <!-- /.content-wrapper -->
        <?= $this->render('footer') ?>

    </div><!-- ./wrapper -->

    <?php $this->endBody(); ?>
    </body>
    </html>
<?php $this->endPage(); ?>