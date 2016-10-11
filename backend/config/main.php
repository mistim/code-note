<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);
// change base url for admin panel in .htaccess
$adminBaseUrl = '/admin_7a1M8O';

return [
    'id' => 'app-backend',
    'language'  => 'ru',
    'sourceLanguage' => 'en-US',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'rbac' => [
            'class' => 'backend\modules\rbac\Module',
            'controllerMap' => [
                'assignment' => [
                    'class' => 'backend\modules\rbac\controllers\AssignmentController',
                    'userClassName' => 'backend\models\User',
                ]
            ]
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
            'baseUrl' => $adminBaseUrl,
        ],
        'user' => [
            'identityClass' => 'backend\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
            'scriptUrl' => '/backend/index.php',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
            ],
        ],
        'authManager' => [
            'class'           => 'yii\rbac\DbManager',
            'defaultRoles'    => ['Guest', 'user', 'admin'],
            'cache'           => 'yii\caching\FileCache',
            'itemTable'       => 'auth_item',
            'itemChildTable'  => 'auth_item_child',
            'assignmentTable' => 'auth_assignment',
            'ruleTable'       => 'auth_rule',
        ],
        'view' => [
            'theme' => [
                'basePath' => '@backend/themes/adminlte',
                'baseUrl' => '@backend/themes/adminlte',
                /*'pathMap' => [
                    '@backend/views' => '@backend/themes/adminlte',
                ],*/
            ],
        ],

        'i18n' => [
            'translations' => [
                'admin*' => [
                    'class' => 'yii\i18n\DbMessageSource',
                    'sourceLanguage' => 'en-US',
                    'on missingTranslation' => ['common\components\TranslationEventHandler', 'handleMissingTranslation'],
                    'enableCaching' => false
                ],
            ],
        ],
    ],
    'params' => $params,
];
