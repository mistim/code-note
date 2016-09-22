<?php

/**
 * Head layout.
 */

use backend\themes\adminlte\assets;
use yii\helpers\Html;
use yii\helpers\Url;
use backend\assets\AppAsset;

?>
<title><?= Html::encode($this->title); ?></title>
<?= Html::csrfMetaTags(); ?>
<?php $this->head(); ?>
<!--    <link rel="apple-touch-icon" sizes="57x57" href="/img/icons/apple-touch-icon-57x57.png">-->
<!--    <link rel="apple-touch-icon" sizes="60x60" href="/img/icons/apple-touch-icon-60x60.png">-->
<!--    <link rel="apple-touch-icon" sizes="72x72" href="/img/icons/apple-touch-icon-72x72.png">-->
<!--    <link rel="apple-touch-icon" sizes="76x76" href="/img/icons/apple-touch-icon-76x76.png">-->
<!--    <link rel="apple-touch-icon" sizes="114x114" href="/img/icons/apple-touch-icon-114x114.png">-->
<!--    <link rel="apple-touch-icon" sizes="120x120" href="/img/icons/apple-touch-icon-120x120.png">-->
<!--    <link rel="apple-touch-icon" sizes="144x144" href="/img/icons/apple-touch-icon-144x144.png">-->
<!--    <link rel="apple-touch-icon" sizes="152x152" href="/img/icons/apple-touch-icon-152x152.png">-->
<!--    <link rel="apple-touch-icon" sizes="180x180" href="/img/icons/apple-touch-icon-180x180.png">-->
<!--    <link rel="icon" type="image/png" href="/img/icons/favicon-32x32.png" sizes="32x32">-->
<!--    <link rel="icon" type="image/png" href="/img/icons/favicon-194x194.png" sizes="194x194">-->
<!--    <link rel="icon" type="image/png" href="/img/icons/favicon-96x96.png" sizes="96x96">-->
<!--    <link rel="icon" type="image/png" href="/img/icons/android-chrome-192x192.png" sizes="192x192">-->
<!--    <link rel="icon" type="image/png" href="/img/icons/favicon-16x16.png" sizes="16x16">-->
<!--    <link rel="manifest" href="/img/icons/manifest.json">-->
<!--    <link rel="mask-icon" href="/img/icons/safari-pinned-tab.svg" color="#2fa31c">-->

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->

<?php
assets\AdminLteAsset::register($this);
AppAsset::register($this);
assets\BootboxAsset::overrideSystemConfirm();

$this->registerMetaTag(
    [
        'charset' => Yii::$app->charset
    ]
);
$this->registerMetaTag(
    [
        'name' => 'viewport',
        'content' => 'width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'
    ]
);
$this->registerLinkTag(
    [
        'rel' => 'canonical',
        'href' => Url::canonical()
    ]
); ?>