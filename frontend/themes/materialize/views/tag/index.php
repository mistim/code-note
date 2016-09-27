<?php

use yii\widgets\ListView;

/* @var $model \common\models\Tag */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>

<div class="card-panel">
	<h1 class="center-align">Tag: <?= $model->title ?></h1>
</div>

<div id="list-post">
	<?= ListView::widget([
		'dataProvider' => $dataProvider,
		'itemView' => '_view',
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