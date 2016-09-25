<?php

use yii\helpers\Url;
use backend\widgets\imperavi\Widget;
use backend\widgets\fileapi\Widget as FileAPI;
use common\models\Category;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\bootstrap\ActiveForm */

?>

<?= $form->field($model, 'status')->checkbox([
	'template' => "{label}<div class='col-sm-6'>\n{input}\n{error}\n{hint}</div>"
])
	->label(null, ['class' => 'control-label col-sm-3']) ?>

<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'posted_at')->textInput() ?>

<?= $form->field($model, 'category_id')->dropDownList(
	ArrayHelper::map(Category::getAllActive(), 'id', 'title'),
	['prompt' => 'Choice category']
) ?>

<?= $form->field($model, 'image')->widget(FileAPI::className(),
	[
		'settings' => [
			'url' => ['fileapi-upload'],
		],
		'jcropSettings' => [
			'bgColor' => '#ffffff',
			'aspectRatio' => 960/300,
			'maxSize' => [1920, 600],
			'minSize' => [480, 150],
			'keySupport' => false,
			'selection' => '100%'
		],
		'crop' => true,
		'cropResizeWidth' => 960,
		'cropResizeHeight' => 300
	]
) ?>

<?= $form->field($model, 'teaser')->widget(Widget::className(), [
	'settings' => [
		'lang'             => 'ru',
		'minHeight'        => 210,
		'imageManagerJson' => Url::to(['uploader/image-get']),
		'imageUpload'      => Url::to(['uploader/image-upload']),
		'fileManagerJson'  => Url::to(['uploader/file-get']),
		'fileUpload'       => Url::to(['uploader/file-upload']),
		'plugins'          => [
			'fullscreen',
			'clips',
			'table',
			'imagemanager',
			'filemanager'
		]
	]
])->textarea(['class' => 'redactor']) ?>

<?= $form->field($model, 'text')->widget(Widget::className(), [
	'settings' => [
		'lang'             => 'ru',
		'minHeight'        => 400,
		'imageManagerJson' => Url::to(['uploader/image-get']),
		'imageUpload'      => Url::to(['uploader/image-upload']),
		'fileManagerJson'  => Url::to(['uploader/file-get']),
		'fileUpload'       => Url::to(['uploader/file-upload']),
		'plugins'          => [
			'fullscreen',
			'clips',
			'table',
			'imagemanager',
			'filemanager'
		]
	]
])->textarea(['class' => 'redactor']) ?>
