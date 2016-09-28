<?php

namespace backend\widgets\imperavi;

use yii\web\AssetBundle;

/**
 * Class Asset
 * @package backend\widgets\imperavi
 */
class Asset extends AssetBundle
{
	/**
	 * @inheritdoc
	 */
	public $sourcePath = '@backend/widgets/imperavi/assets';

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
		'redactor.m.css',
		//'codemirror/codemirror.css',
	];

	/**
	 * @inheritdoc
	 */
	public $js = [
	    'redactor.m.js',
	    //'codemirror/codemirror.js',
	];

	/**
	 * @inheritdoc
	 */
	public $depends = [
		'yii\web\JqueryAsset'
	];

	/**
	 * Register asset bundle language files and plugins.
	 */
	public function registerAssetFiles($view)
	{
		if ($this->language !== null) {
			$this->js[] = 'lang/' . $this->language . '.m.js';
		}
		if (!empty($this->plugins)) {
			foreach ($this->plugins as $plugin) {
				if ($plugin === 'clips') {
					$this->css[] = 'plugins/' . $plugin . '/' . $plugin . '.m.css';
				}
				$this->js[] = 'plugins/' . $plugin . '/' . $plugin .'.m.js';
			}
		}
		parent::registerAssetFiles($view);
	}
}
