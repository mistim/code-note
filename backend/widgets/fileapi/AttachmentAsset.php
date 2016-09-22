<?php

namespace backend\widgets\fileapi;

use yii\web\AssetBundle;

/**
 * Single upload asset bundle.
 */
class AttachmentAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
	public $sourcePath = '@app/widgets/fileapi/assets';

    /**
     * @inheritdoc
     */
	public $css = [
	    //'css/attachment.css'
	];

	public $js = [
	];

    /**
     * @inheritdoc
     */
	public $depends = [
		'backend\widgets\fileapi\Asset'
	];
}
