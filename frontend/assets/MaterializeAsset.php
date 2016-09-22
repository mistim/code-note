<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Class MaterializeAsset
 * @package frontend\assets
 */
class MaterializeAsset extends AssetBundle
{
	/**
	 * @inheritdoc
	 */
	public $sourcePath = '@vendor/bower/materialize/dist';

	/**
	 * @inheritdoc
	 */
	public $css = [
		'http://fonts.googleapis.com/icon?family=Material+Icons',
		'css/materialize.min.css',
	];

	public $js = [
		'js/materialize.min.js',
	];

	public $depends = [
		'yii\web\JqueryAsset',
	];
}