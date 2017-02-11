<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    // при включенном debug повторный вывод view
    //'catchAll' => ['/site/offline'],
    'language'  => 'ru',
    'sourceLanguage' => 'en_US',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    //'layout' => '@frontend/themes/materialize/views/layouts/main',
    'modules' => [
        'sitemap' => [
            'class' => 'frontend\modules\sitemap\Module',
            'models' => [
                // your models
                'common\models\Post',
                'common\models\Note',
                'common\models\Category',
                'common\models\Tag',
            ],
            /*'urls'=> [
                // your additional urls
                [
                    'loc' => '/news/index',
                    'changefreq' => \frontend\modules\sitemap\behaviors\SitemapBehavior::CHANGEFREQ_DAILY,
                    'priority' => 0.8,
                    'news' => [
                        'publication'   => [
                            'name'          => 'Example Blog',
                            'language'      => 'en',
                        ],
                        'access'            => 'Subscription',
                        'genres'            => 'Blog, UserGenerated',
                        'publication_date'  => 'YYYY-MM-DDThh:mm:ssTZD',
                        'title'             => 'Example Title',
                        'keywords'          => 'example, keywords, comma-separated',
                        'stock_tickers'     => 'NASDAQ:A, NASDAQ:B',
                    ],
                    'images' => [
                        [
                            'loc'           => 'http://example.com/image.jpg',
                            'caption'       => 'This is an example of a caption of an image',
                            'geo_location'  => 'City, State',
                            'title'         => 'Example image',
                            'license'       => 'http://example.com/license',
                        ],
                    ],
                ],
            ],*/
            'enableGzip' => true, // default is false
            'cacheExpire' => 1, // 1 second. Default is 24 hours
        ],
    ],
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
                ['pattern'=>'sitemap', 'route' => 'sitemap/default/index', 'suffix' => '.xml']
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
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\DbMessageSource',
                    'sourceLanguage' => 'en-US',
                    'on missingTranslation' => ['common\components\TranslationEventHandler', 'handleMissingTranslation'],
                    'enableCaching' => false,
                    'cachingDuration' => 0
                ],
                'admin*' => [
                    'class' => 'yii\i18n\DbMessageSource',
                    'sourceLanguage' => 'en-US',
                    'on missingTranslation' => ['common\components\TranslationEventHandler', 'handleMissingTranslation'],
                    'enableCaching' => false,
                    'cachingDuration' => 0
                ],
            ],
        ],
    ],
    'params' => $params,
];
