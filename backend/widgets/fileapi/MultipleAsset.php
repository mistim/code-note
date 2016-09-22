<?php

namespace backend\widgets\fileapi;

use yii\web\AssetBundle;

/**
 * Multiple upload asset bundle.
 */
class MultipleAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
	public $sourcePath = '@app/widgets/fileapi/assets';

    /**
     * @inheritdoc
     */
	public $css = [
	    'css/multiple.css'
	];

    /**
     * @inheritdoc
     */
	public $depends = [
		'backend\widgets\fileapi\Asset'
	];
}
