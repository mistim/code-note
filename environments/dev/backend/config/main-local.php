<?php

$config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '',
        ],
        'assetManager' => [
            'bundles' => [
                'backend\assets\AdminLteAsset' => [
                    'sourcePath' => '@backend/web/plugins/admin-lte/'
                ],
                'frontend\assets\BootboxAsset' => [
                    'sourcePath' => '@backend/web/plugins/bootbox/'
                ],
                'frontend\assets\FontAwesomeAsset' => [
                    'sourcePath' => '@backend/web/plugins/font-awesome/'
                ],
                'frontend\assets\FullCalendarAsset' => [
                    'sourcePath' => '@backend/web/plugins/admin-lte/'
                ],
                'frontend\assets\Select2Asset' => [
                    'sourcePath' => '@backend/web/plugins/admin-lte/'
                ],
                'frontend\assets\TimePickerAsset' => [
                    'sourcePath' => '@backend/web/plugins/admin-lte/'
                ],
            ]
        ],
    ],
];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'generators' => [
            'crud'   => [
                'class'     => 'yii\gii\generators\crud\Generator',
                'templates' => ['adminlte' => '@backend/themes/adminlte/generators/crud/default']
            ]
        ]
    ];
}

return $config;
