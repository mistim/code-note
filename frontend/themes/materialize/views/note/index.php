<?php

use yii\widgets\ListView;

/* @var $dataProvider yii\data\ActiveDataProvider */

?>

<h1 class="center-align">Posts</h1>

<div id="list-post">
	<?= ListView::widget([
		'dataProvider' => $dataProvider,
		'itemView' => '/common/_note',
		'pager' => [
			'firstPageLabel' => '<i class="material-icons">first_page</i>',
			'lastPageLabel' => '<i class="material-icons">last_page</i>',
			'prevPageLabel' => '<i class="material-icons">chevron_left</i>',
			'nextPageLabel' => '<i class="material-icons">chevron_right</i>',
			'activePageCssClass' => 'active cyan darken-2',
			'options' => [
				'tag' => 'div',
				'class' => 'pagination center-align',
				'id' => 'pager-container',
			],
		],
	]); ?>
</div>