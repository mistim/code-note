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
		'css/materialize.min.css',
	];

	public $js = [
		'js/materialize.min.js',
	];

	public $depends = [
		'yii\web\JqueryAsset',
		'frontend\assets\MaterialDesignIconsAsset'
	];
}