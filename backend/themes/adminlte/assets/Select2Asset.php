<?php

namespace backend\themes\adminlte\assets;

use yii\web\AssetBundle;

/**
 * Class Select2Asset
 * @package backend\themes\adminlte\assets
 */
class Select2Asset extends AssetBundle
{
	//public $sourcePath = '@vendor/bower/admin-lte/plugins';
	public $sourcePath = '@backend/web/plugins/admin-lte/plugins';

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
