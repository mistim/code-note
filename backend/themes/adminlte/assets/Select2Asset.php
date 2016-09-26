<?php

namespace backend\themes\adminlte\assets;

use yii\web\AssetBundle;

/**
 * Class Select2Asset
 * @package backend\themes\adminlte\assets
 */
class Select2Asset extends AssetBundle
{
	public $sourcePath = '@vendor/almasaeed2010/adminlte/plugins';

	public $css = [
		'select2/select2.min.css',
	];

	public $js = [
		'select2/select2.min.js',
	];

	public $depends = [
		'yii\web\YiiAsset',
		'yii\bootstrap\BootstrapAsset',
		'backend\themes\adminlte\assets\BootboxAsset',
	];
}
