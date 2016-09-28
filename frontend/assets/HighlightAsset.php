<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\View;
use yii\helpers\Json;

/**
 * Class HighlightAsset
 * @package frontend\assets
 */
class HighlightAsset extends AssetBundle
{
	const DEFAULT_SELECTOR = 'pre code';

	public $sourcePath = '@frontend/web/plugins/highlight/';

	public $css = [
		'styles/darkula.css',
	];

	public $js = [
		'highlight.pack.js',
	];

	public $depends = [
		'yii\web\JqueryAsset',
	];

	/**
	 * @var string Preferred selector on which code Highlight would be applied.
	 */
	public $selector = 'pre'; //self::DEFAULT_SELECTOR;

	/**
	 * @var array of options to be declared as js object with global
	 *      [configuration](http://highlightjs.readthedocs.org/en/latest/api.html#configure-options)
	 */
	public $options = [
		'tabReplace' => '    ',
	];

	/**
	 * @param View $view
	 *
	 * @return static the registered asset bundle instance
	 */
	public static function register($view)
	{
		$configOptions  = [];
		$configSelector = self::DEFAULT_SELECTOR;

		try {
			/** @var self $thisBundle */
			$thisBundle     = \Yii::$app->getAssetManager()->getBundle(__CLASS__);
			$configOptions  = $thisBundle->options;
			$configSelector = $thisBundle->selector;
		} catch (\Exception $e) {
			// do nothing...
		}

		$options = empty($configOptions) ? '' : Json::encode($configOptions);

		if ($configSelector !== self::DEFAULT_SELECTOR) {
			$view->registerJs('
                hljs.configure(' . $options . ');
                jQuery(\'' . $configSelector . '\').each(function(i, block) {
                    hljs.highlightBlock(block);
                });');
		} else {
			$view->registerJs('
                hljs.configure(' . $options . ');
                hljs.initHighlightingOnLoad();'
			);
		}

		return parent::register($view);
	}
}