<?php
/**
 * Configuration file for the "yii asset" console command.
 */

// In the console environment, some path aliases may not exist. Please define these:
Yii::setAlias('@webroot', __DIR__ . '/frontend/web');
Yii::setAlias('@web', '/');
Yii::setAlias('@compressor', __DIR__ . '/data/compressor');

return [
	// Adjust command/callback for JavaScript files compressing:
	'jsCompressor'  => 'java -jar ' . Yii::getAlias('@compressor') . '/closure-compiler.jar --js {from} --js_output_file {to}',
	// Adjust command/callback for CSS files compressing:
	'cssCompressor' => 'java -jar ' . Yii::getAlias('@compressor') . '/yuicompressor.jar --type css {from} -o {to}',
	// The list of asset bundles to compress:
	'bundles'       => [
		'yii\web\YiiAsset',
		'yii\web\JqueryAsset',
		'yii\widgets\ActiveFormAsset',
		'yii\widgets\PjaxAsset',
		'yii\captcha\CaptchaAsset',
		'yii\validators\ValidationAsset',
		'frontend\assets\MaterialDesignIconsAsset',
		'frontend\assets\MaterializeAsset',
		'frontend\assets\AppAsset',
	],
	// Asset bundle for compression output:
	'targets'       => [
		'all' => [
            'class'    => 'yii\web\AssetBundle',
            'basePath' => '@webroot/assets/nimify',
            'baseUrl'  => '@web/assets/nimify',
            'js'       => 'all-{hash}.js',
            'css'      => 'all-{hash}.css',
		],
        // закомментировать при генерации assets
        /*'frontend\assets\HighlightAsset' => [
            'selector'   => '.hl-code',
            'sourcePath' => '@frontend/web/plugins/highlight/',
        ],*/
	],
	// Asset manager configuration:
	'assetManager'  => [
		'basePath' => '@webroot/assets',
		'baseUrl'  => '@web/assets',
	],
];