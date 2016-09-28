<?php

namespace frontend\assets;
use yii\web\AssetBundle;

class MaterialDesignIconsAsset extends AssetBundle
{
	/**
	 * @inheritdoc
	 */
	public $sourcePath = '@vendor/bower/material-design-icons';

	/**
	 * @inheritdoc
	 */
	public $css = [
		'iconfont/material-icons.css',
	];

	public $js = [

	];

	public $depends = [

	];
}