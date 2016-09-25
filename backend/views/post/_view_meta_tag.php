<?php

use yii\widgets\DetailView;
use backend\helpers\ToolsHelper;

/* @var $this yii\web\View */
/* @var $meta_tag common\models\MetaTag */

echo DetailView::widget([
	'model' => $meta_tag,
	'attributes' => [
		'id',
		'title',
		'keyword',
		'description',
	],
]);