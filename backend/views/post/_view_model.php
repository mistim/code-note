<?php

use yii\widgets\DetailView;
use backend\helpers\ToolsHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Post */

echo DetailView::widget([
	'model' => $model,
	'attributes' => [
		'id',
		'title',
		'alias',
		'image',
		[
			'attribute' => 'status',
			'format' => 'html',
			'value' => ToolsHelper::getStatusStr($model->status)
		],
		'posted_at:datetime',
		'category.title',
		'creator.username',
		'editor.username',
		'created_at:datetime',
		'updated_at:datetime',
		'teaser:html',
		'text:html',
	],
]);