<?php

use yii\widgets\DetailView;
use backend\helpers\ToolsHelper;
use yii\helpers\ArrayHelper;

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
		'category.title',
		[
			'attribute' => 'tags',
			//'label' => 'Tags',
			'value' => implode(', ', ArrayHelper::map($model->tags, 'id', 'title'))
		],
		[
			'attribute' => 'creator.username',
			'label' => Yii::t('admin', 'Creator')
		],
		[
			'attribute' => 'editor.username',
			'label' => Yii::t('admin', 'Editor')
		],
		'created_at:datetime',
		'updated_at:datetime',
		'teaser:html',
		'text:html',
	],
]);