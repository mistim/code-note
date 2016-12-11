<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'timeZone' => 'Europe/Kiev',
    'charset' => 'UTF-8',
    'name' => 'Code Note',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        /*'formatter' => [
            'dateFormat'             => 'dd.MM.yyyy',
            'datetimeFormat'         => 'dd.MM.yyyy HH:mm',
            'timeFormat'             => 'raw',
            'timeZone'               => 'UTC',
            'decimalSeparator'       => '.',
            'thousandSeparator'      => ' ',
            'numberFormatterOptions' => [
                NumberFormatter::MIN_FRACTION_DIGITS => 0,
                NumberFormatter::MAX_FRACTION_DIGITS => 0,
            ],
            'nullDisplay'            => '',
        ],*/
        'cacheFrontend' => [
            'class' => 'yii\caching\FileCache',
            'cachePath' => Yii::getAlias('@frontend') . '/runtime/cache'
        ],
    ],
];
