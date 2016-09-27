<?php

use yii\widgets\DetailView;
use backend\helpers\ToolsHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Category */

echo DetailView::widget([
	'model' => $model,
	'attributes' => [
		'id',
		'title',
		[
			'attribute' => 'status',
			'format' => 'html',
			'value' => ToolsHelper::getStatusStr($model->status)
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
	],
]);