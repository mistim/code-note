<?php

use yii\helpers\Html;
use frontend\helpers\ViewTools;

/** @var $this \yii\web\View */
/** @var $model \common\models\Note */
/** @var $prev \common\models\Note */
/** @var $next \common\models\Note */
?>

<div class="note-view">
	<div class="card card-view">
		<div class="card-head col-block">
			<h1><?= $model->title ?></h1>
			<div class="post-info-block right-align">
				<span class="post-info">
					<?= Html::a('<i class="material-icons">chevron_left</i> Back to List', ['/note'], ['class' => 'left']) ?>
				</span>
				<span class="post-info">
					<i class="material-icons blue-grey-text text-darken-2 tooltipped" data-position="top" data-delay="50" data-tooltip="date created">event_note</i>
					<span class="post-info-text"><?= $model->posted_at ?></span>
				</span>
				<span class="post-info">
					<i class="material-icons blue-grey-text text-darken-2 tooltipped" data-position="top" data-delay="50" data-tooltip="category">library_books</i>
					<span class="post-info-text">
						<?= Html::a($model->category->title, ['/note/category/' . $model->category->alias]) ?>
					</span>
				</span>
				<span class="post-info">
					<i class="material-icons blue-grey-text text-darken-2 tooltipped" data-position="top" data-delay="50" data-tooltip="tags">style</i>
					<span class="post-info-text">
						<?= implode(', ', ViewTools::getTagLinks($model)) ?>
					</span>
				</span>
				<span class="post-info">
					<i class="material-icons blue-grey-text text-darken-2 tooltipped" data-position="top" data-delay="50" data-tooltip="quantity views">visibility</i>
					<span class="post-info-text">
						<?= $model->cnt_view ?>
					</span>
				</span>
			</div>
		</div>
		<div class="card-content">
			<?= $model->text ?>
		</div>
	</div>
</div>

<div class="card-panel">
	<div class="card-content">
		<div class="col s6 left-align">
			<?php if($prev): ?>
				<p>Prev:</p>
				<h5><?= Html::a($prev->title, ['/note/' . $prev->alias]) ?></h5>
			<?php endif; ?>
		</div>
		<div class="col s6 right-align">
			<?php if($next): ?>
				<p>Next:</p>
				<h5><?= Html::a($next->title, ['/note/' . $next->alias]) ?></h5>
			<?php endif; ?>
		</div>
	</div>
</div>
