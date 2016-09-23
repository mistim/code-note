<?php

/** @var $this \yii\web\View */
/** @var $model \common\models\Note */

?>

<div class="note-view">
	<div class="card hoverable">
		<div class="card-head col-block">
			<h1><?= $model->title ?></h1>
			<div class="post-info-block right">
				<span class="post-info">
					<i class="material-icons blue-grey-text text-darken-2 tooltipped" data-position="bottom" data-delay="50" data-tooltip="date created">event_note</i>
					<span class="post-info-text"><?= $model->posted_at ?></span>
				</span>
				<span class="post-info">
					<i class="material-icons blue-grey-text text-darken-2 tooltipped" data-position="bottom" data-delay="50" data-tooltip="category">library_books</i>
					<span class="post-info-text"><?= $model->category->title ?></span>
				</span>
				<span class="post-info">
					<i class="material-icons blue-grey-text text-darken-2 tooltipped" data-position="bottom" data-delay="50" data-tooltip="tags">style</i>
					<span class="post-info-text">Aaa</span>
				</span>
				<span class="post-info">
					<i class="material-icons blue-grey-text text-darken-2 tooltipped" data-position="bottom" data-delay="50" data-tooltip="quantity views">visibility</i>
					<span class="post-info-text">7</span>
				</span>
			</div>
		</div>
		<div class="card-content">
			<?= $model->content ?>
		</div>
	</div>
</div>
