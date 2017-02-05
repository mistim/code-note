<?php

use yii\widgets\ListView;

/* @var $model \common\models\Category|\common\models\Tag */
/* @var $text_block \common\models\TextBlock */
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
            <?= $text_block->text ?>
		</div>
	<?php endif; ?>
</div>

<?php if ($dataProvider): ?>
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
<?php else: ?>
	<div class="card-panel card-view">
		<div class="card-content"><?= Yii::t('app', 'Nothing') ?></div>
	</div>
<?php endif; ?>
