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

// Конфигурация по умолчанию для виджета TinyMCE.
/*Yii::$container->set('dosamigos\tinymce\TinyMce', [
	'language' => 'ru',
	'options' => ['rows' => 6],
	'clientOptions' => [
		'plugins' => [
			"advlist autolink lists link charmap hr preview pagebreak",
			"searchreplace wordcount textcolor visualblocks visualchars code fullscreen nonbreaking",
			"save insertdatetime media table contextmenu template paste image responsivefilemanager filemanager",
		],
		'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | responsivefilemanager link image media",
		'external_filemanager_path' => '/admin_7a1M8O/plugins/responsivefilemanager/filemanager/',
		'filemanager_title' => 'Responsive Filemanager',
		'external_plugins' => [
			// Кнопка загрузки файла в диалоге вставки изображения.
			'filemanager' => '/admin_7a1M8O/plugins/responsivefilemanager/filemanager/plugin.min.js',
			// Кнопка загрузки файла в тулбаре.
			'responsivefilemanager' => '/admin_7a1M8O/plugins/responsivefilemanager/tinymce/plugins/responsivefilemanager/plugin.min.js',
		],
	]
]);*/
