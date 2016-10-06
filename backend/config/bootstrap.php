<?php

use yii\helpers\Url;
use backend\widgets\imperavi\Widget;
use yii\web\JsExpression;

Yii::setAlias('@web', '/admin_7a1M8O');

Yii::$container->set(Widget::className(), [
	'settings' => [
		'lang'              => 'ru',
		'minHeight'         => 210,
		'imageManagerJson'  => Yii::getAlias('@web/uploader/image-get'),
		'imageUpload'       => Yii::getAlias('@web/uploader/image-upload'),
		'fileManagerJson'   => Yii::getAlias('@web/uploader/file-get'),
		'fileUpload'        => Yii::getAlias('@web/file-upload'),
		//'definedLinks' => Yii::getAlias('@web/redactor/link-get'),
		'formatting' => ['p', 'blockquote', 'pre', 'h1', 'h2', 'h3', 'h4', 'h5'],
		'formattingAdd' => [
			'php' => [
				'title' => 'Code PHP',
				'args' => ['pre', 'class', 'hl-code php']
			],
			'html' => [
				'title' => 'Code HTML',
				'args' => ['pre', 'class', 'hl-code html']
			],
			'css' => [
				'title' => 'Code CSS',
				'args' => ['pre', 'class', 'hl-code css']
			],
			'javascript' => [
				'title' => 'Code JavaScript',
				'args' => ['pre', 'class', 'hl-code javascript']
			],
		],
		'plugins'           => [
			'source',
			'alignment',
			'table',
			//'definedlinks',
			'imagemanager',
			'filemanager',
			'video',
			'counter',
			//'inlinestyle',
			'limiter',
			'properties',
			'textdirection',
			//'textexpander',
			'clips',
			'fullscreen',
			'iconic',
			//'codemirror',
			//'hightline'
		],
		/*'codemirror' => [
			'lineNumbers' => true,
			'indentUnit' => 4,
			'mode' => 'xml'
		],*/
		'buttons' => [
			'html', 'format', 'bold', 'italic', 'underline', 'deleted', 'alignment',
			'lists', 'properties', 'table', 'link', 'image', 'video', 'file', 'inline',
			'clips', 'textdirection', 'fullscreen'
		],
		'callbacks'         => new JsExpression("{
                    counter: function(data)
                    {
                        $('.cnt-word-total').text(data.words);
                        $('.cnt-char-total').text(data.characters);
                        $('.cnt-char-left').text($('#category-teaser').attr('maxlength')- data.characters);
                    }
                }"),
	],
]);

