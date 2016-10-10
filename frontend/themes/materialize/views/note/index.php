<?php

use yii\widgets\ListView;

/* @var $model \common\models\Category|\common\models\Tag */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>

<div class="card-panel card-view">
	<?php if ($model): ?>
		<?php $titleModel = $model::className() === 'common\models\Category' ? 'Category' : 'Tag'; ?>

		<h1 class="center-align"><?= $titleModel ?>: <?= $model->title ?></h1>
		<?php if ($titleModel === 'Category' && $model->teaser): ?>

			<div class="card-content">
				<?= $model->teaser ?>
			</div>

		<?php endif; ?>
	<?php else: ?>
		<h1 class="center-align"><?= Yii::t('app', 'Notes') ?></h1>
		<div class="card-content">
			Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Lorem ipsum dolor sit amet, consectetur
			adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
			Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Vestibulum ac diam sit amet
			quam vehicula elementum sed sit amet dui. Praesent sapien massa, convallis a pellentesque nec, egestas non
			nisi. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit
			neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Pellentesque in ipsum id orci porta
			dapibus. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Vivamus suscipit tortor
			eget felis porttitor volutpat. Donec sollicitudin molestie malesuada.
		</div>
	<?php endif; ?>
</div>

<div id="list-note">

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