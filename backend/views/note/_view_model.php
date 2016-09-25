<?php

use yii\widgets\DetailView;
use backend\helpers\ToolsHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Note */

echo DetailView::widget([
	'model' => $model,
	'attributes' => [
		'id',
		'title',
		'alias',
		[
			'attribute' => 'status',
			'format' => 'html',
			'value' => ToolsHelper::getStatusStr($model->status)
		],
		'posted_at:datetime',
		'creator.username',
		'editor.username',
		'created_at:datetime',
		'updated_at:datetime',
		'teaser:html',
		'text:html',
	],
]);