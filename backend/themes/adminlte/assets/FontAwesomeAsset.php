<?php

namespace backend\themes\adminlte\assets;

use yii\web\AssetBundle;

/**
 * Class FontAwesomeAsset
 * @package backend\themes\adminlte\assets
 */
class FontAwesomeAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@vendor/bower/font-awesome';

    /**
     * @inheritdoc
     */
    public $css = [
        'css/font-awesome.min.css',
    ];

    public $js = [];
}
