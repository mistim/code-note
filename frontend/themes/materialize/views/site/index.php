<?php

use yii\widgets\ListView;

/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $text_block \common\models\TextBlock */

?>

<div class="card-panel card-view">
	<?php if($text_block): ?>
	<h1 class="center-align"><?= $text_block->title ?></h1>
	<div class="card-content">
		<?= $text_block->text ?>
	</div>
	<?php else: ?>
		<h1 class="center-align"><?= Yii::t('app', 'Notes code') ?></h1>
	<?php endif; ?>
</div>

<div id="list-post">
	<?= ListView::widget([
		'dataProvider' => $dataProvider,
		'itemView' => '/common/_view',
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
