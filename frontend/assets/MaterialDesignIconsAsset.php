<?php

namespace frontend\assets;
use yii\web\AssetBundle;

/**
 * Class MaterialDesignIconsAsset
 * @package frontend\assets
 */
class MaterialDesignIconsAsset extends AssetBundle
{
	/**
	 * @inheritdoc
	 */
	//public $sourcePath = '@vendor/bower/material-design-icons';
	public $sourcePath = '@frontend/web/plugins/material-design-icons';

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