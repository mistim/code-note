<?php

namespace backend\themes\adminlte\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class FullCalendarAsset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/plugins';

    public $css = [
        'fullcalendar/fullcalendar.min.css',
    ];

    public $js = [
        'daterangepicker/moment.min.js',
        'fullcalendar/fullcalendar.min.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'backend\themes\adminlte\assets\BootboxAsset',
    ];
}
