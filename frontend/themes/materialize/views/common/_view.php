<?php

use yii\helpers\Html;
use frontend\helpers\ViewTools;

/** @var $this \yii\web\View */
/** @var $model \common\models\Post */

//$this->registerJs($js);
$controller = $model->is_post ? '/post' : '/note';
?>

<div class="row">
	<div class="col s12">
		<div class="card hoverable card-view">
			<?php if ($model->is_post): ?>
				<div class="card-head col-block">
					<h3><?= Html::a($model->title, [$controller . '/' . $model->alias]) ?></h3>
				</div>
				<div class="card-image">
					<?= Html::img($model->urlAttribute('image')) ?>
				</div>
			<?php else: ?>
				<div class="note card-head col-block">
					<h3><?= Html::a($model->title, [$controller . '/' . $model->alias]) ?></h3>
				</div>
			<?php endif; ?>
			<div class="card-content">
				<?= $model->teaser ?>
			</div>
			<div class="waves card-action col-block">
				<div class="col s9 left-align">
					<span class="post-info">
					<i class="material-icons blue-grey-text text-darken-2 tooltipped" data-position="top" data-delay="50" data-tooltip="date created">event_note</i>
					<span class="post-info-text"><?= Yii::$app->formatter->format($model->posted_at, 'date') ?></span>
				</span>
				<span class="post-info">
					<i class="material-icons blue-grey-text text-darken-2 tooltipped" data-position="top" data-delay="50" data-tooltip="category">library_books</i>
					<span class="post-info-text">
						<?= Html::a($model->category->title, [$controller . '/category/' . $model->category->alias]) ?>
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
				<div class="col s3 right-align">
					<?= Html::a(
						'Read more',
						[$controller . '/' . $model->alias],
						['class' => 'waves-effect']
					) ?>
				</div>

			</div>
		</div>
	</div>
</div>