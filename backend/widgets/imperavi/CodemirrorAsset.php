<?php

namespace backend\widgets\imperavi;

use yii\web\AssetBundle;

/**
 * Class CodemirrorAsset
 * @package backend\widgets\imperavi
 */
class CodemirrorAsset extends AssetBundle
{
	/**
	 * @inheritdoc
	 */
	public $sourcePath = '@backend/widgets/imperavi/assets/codemirror';

	/**
	 * @var string Redactor language
	 */
	public $language;

	/**
	 * @var array Redactor plugins array
	 */
	public $plugins = [];

	/**
	 * @inheritdoc
	 */
	public $css = [
		'codemirror.css',
	];

	/**
	 * @inheritdoc
	 */
	public $js = [
	    'codemirror.js'
	];

	/**
	 * @inheritdoc
	 */
	public $depends = [
		'yii\web\JqueryAsset'
	];
}
