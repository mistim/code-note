<?php

$config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '',
        ],
        'assetManager' => [
            'bundles' => [
                'frontend\assets\HighlightAsset' => [
                    'selector'   => '.hl-code',
                    'sourcePath' => '@frontend/web/plugins/highlight/'
                ],
                'frontend\assets\MaterialDesignIconsAsset' => [
                    'sourcePath' => '@frontend/web/plugins/material-design-icons/'
                ],
                'frontend\assets\MaterializeAsset' => [
                    'sourcePath' => '@frontend/web/plugins/materialize/'
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
    ];
}

return $config;
