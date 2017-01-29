<?php

use yii\helpers\Html;
use frontend\helpers\ViewTools;

/** @var $this \yii\web\View */
/** @var $model \common\models\Post */
/** @var $prev \common\models\Post */
/** @var $next \common\models\Post */

?>

<div class="post-view">
	<div class="card card-view">
		<div class="card-head col-block">
			<h1><?= $model->title ?></h1>
			<div class="post-info-block right-align">
				<span class="post-info">
					<?= Html::a(
						Html::tag('i', null, ['class' => 'material-icons']) . Yii::t('app', 'Back to List'),
						[\yii\helpers\Url::previous()],
						['class' => 'left']
					) ?>
				</span>
				<span class="post-info">
					<i class="material-icons blue-grey-text text-darken-2 tooltipped" data-position="top" data-delay="50" data-tooltip="<?= Yii::t('app', 'date created') ?>">event_note</i>
					<span class="post-info-text"><?= Yii::$app->formatter->format($model->posted_at, 'date') ?></span>
				</span>
				<span class="post-info">
					<i class="material-icons blue-grey-text text-darken-2 tooltipped" data-position="top" data-delay="50" data-tooltip="<?= Yii::t('app', 'category') ?>">library_books</i>
					<span class="post-info-text">
						<?= Html::a($model->category->title, ['/post/category/' . $model->category->alias]) ?>
					</span>
				</span>
				<span class="post-info">
					<i class="material-icons blue-grey-text text-darken-2 tooltipped" data-position="top" data-delay="50" data-tooltip="<?= Yii::t('app', 'tags') ?>">style</i>
					<span class="post-info-text">
						<?= implode(', ', ViewTools::getTagLinks($model)) ?>
					</span>
				</span>
				<span class="post-info">
					<i class="material-icons blue-grey-text text-darken-2 tooltipped" data-position="top" data-delay="50" data-tooltip="<?= Yii::t('app', 'quantity views') ?>">visibility</i>
					<span class="post-info-text">
						<?= $model->cnt_view ?>
					</span>
				</span>
			</div>
		</div>
        <?php if ($model->image): ?>
		<div class="card-image">
			<?= Html::img($model->urlAttribute('image')) ?>
		</div>
        <?php endif; ?>
		<div class="card-content">
			<?= $model->text ?>
		</div>
	</div>
</div>

<div class="card-panel">
	<div class="card-content row-clean">
		<div class="col s6 left-align">
			<?php if($prev): ?>
			<p><?= Yii::t('app', 'Prev:') ?></p>
			<h5><?= Html::a($prev->title, ['/post/' . $prev->alias]) ?></h5>
			<?php endif; ?>
		</div>
		<div class="col s6 right-align">
			<?php if($next): ?>
			<p><?= Yii::t('app', 'Next:') ?></p>
			<h5><?= Html::a($next->title, ['/post/' . $next->alias]) ?></h5>
			<?php endif; ?>
		</div>
	</div>
</div>
