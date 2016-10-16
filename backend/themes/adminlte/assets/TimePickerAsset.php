<?php

namespace backend\themes\adminlte\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class TimePickerAsset extends AssetBundle
{
    //public $sourcePath = '@vendor/bower/admin-lte/plugins';
    public $sourcePath = '@backend/web/plugins/admin-lte/plugins';

    public $css = [
        'timepicker/bootstrap-timepicker.min.css',
    ];

    public $js = [
        'timepicker/bootstrap-timepicker.min.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'backend\themes\adminlte\assets\BootboxAsset',
    ];
}
