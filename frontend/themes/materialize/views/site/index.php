<?php

use yii\widgets\ListView;

/* @var $dataProvider yii\data\ActiveDataProvider */

?>

<h1>Posts</h1>

<p>Welcome to Express</p>

<div id="list-post">
	<?= ListView::widget([
		'dataProvider' => $dataProvider,
		'itemView' => '_view',
		'pager' => [
			//'firstPageLabel' => 'first',
			//'lastPageLabel' => 'last',
			'prevPageLabel' => '<i class="material-icons">chevron_left</i>',
			'nextPageLabel' => '<i class="material-icons">chevron_right</i>',
			'activePageCssClass' => 'active teal darken-2',
			'options' => [
				'tag' => 'div',
				'class' => 'pagination center-align',
				'id' => 'pager-container',
			],
		],
	]); ?>
</div>