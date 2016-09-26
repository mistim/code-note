<?php

use yii\helpers\Html;

/** @var $this \yii\web\View */
/** @var $model \common\models\Post */

?>

<div class="post-view">
	<div class="card card-view">
		<div class="card-head col-block">
			<h1><?= $model->title ?></h1>
			<div class="post-info-block right-align">
				<span class="post-info">
					<?= Html::a('<i class="material-icons">chevron_left</i> Back to List', ['/post'], ['class' => 'left']) ?>
				</span>
				<span class="post-info">
					<i class="material-icons blue-grey-text text-darken-2 tooltipped" data-position="top" data-delay="50" data-tooltip="date created">event_note</i>
					<span class="post-info-text"><?= $model->posted_at ?></span>
				</span>
				<span class="post-info">
					<i class="material-icons blue-grey-text text-darken-2 tooltipped" data-position="top" data-delay="50" data-tooltip="category">library_books</i>
					<span class="post-info-text">
						<?= Html::a($model->category->title, ['/post/category/' . $model->category->alias]) ?>
					</span>
				</span>
				<span class="post-info">
					<i class="material-icons blue-grey-text text-darken-2 tooltipped" data-position="top" data-delay="50" data-tooltip="tags">style</i>
					<span class="post-info-text">Aaa</span>
				</span>
				<span class="post-info">
					<i class="material-icons blue-grey-text text-darken-2 tooltipped" data-position="top" data-delay="50" data-tooltip="quantity views">visibility</i>
					<span class="post-info-text">7</span>
				</span>
			</div>
		</div>
		<div class="card-image">
			<?= Html::img($model->urlAttribute('image')) ?>
		</div>
		<div class="card-content">
			<?= $model->text ?>
		</div>
	</div>
</div>
