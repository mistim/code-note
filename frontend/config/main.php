<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    //'catchAll' => ['/site/offline'],
    'language'  => 'ru',
    'sourceLanguage' => 'en_US',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    //'layout' => '@frontend/themes/materialize/views/layouts/main',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl' => '',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'scriptUrl' => '/index.php',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
                'note/<alias:[\w-]+>'          => 'note/view',
                'post/<alias:[\w-]+>'          => 'post/view',
                'category/<alias:[\w-]+>'      => 'category/index',
                'tag/<alias:[\w-]+>'           => 'tag/index',
                'note/category/<alias:[\w-]+>' => 'note/category',
                'post/category/<alias:[\w-]+>' => 'post/category',
                'note/tag/<alias:[\w-]+>'      => 'note/tag',
                'post/tag/<alias:[\w-]+>'      => 'post/tag',
            ],
        ],
        'assetManager' => [
            'bundles' => [
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'css' => [],
                    'js'  => [],
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [],
                    'js'  => [],
                ],
                'frontend\assets\HighlightAsset' => [
                    'selector'   => '.hl-code',
                    'sourcePath' => '@frontend/web/plugins/highlight/'
                ],
            ],
        ],
        'view' => [
            'theme' => [
                //'basePath' => '@frontend/themes/materialize',
                'baseUrl' => '@frontend/themes/materialize',
                'pathMap' => [
                    '@frontend/views/layouts' => '@frontend/themes/materialize/views/layouts',
                    '@frontend/views' => '@frontend/themes/materialize/views',
                ],
            ],
        ],
    ],
    'params' => $params,
];
