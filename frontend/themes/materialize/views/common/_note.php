<?php

use yii\helpers\Html;

/** @var $this \yii\web\View */
/** @var $model \common\models\Note */

$js = <<<JS
	$('.parallax').parallax();
JS;

//$this->registerJs($js);
?>

<div class="row">
	<div class="col s12">
		<div class="card hoverable card-view">
			<div class="card-content">
				<span class="card-title"><?= $model->title ?></span>
				<?= $model->teaser ?>
			</div>
			<div class="waves card-action col-block">
				<div class="col s9 left-align">
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
					<span class="post-info-text">Aaa</span>
				</span>
				<span class="post-info">
					<i class="material-icons blue-grey-text text-darken-2 tooltipped" data-position="top" data-delay="50" data-tooltip="quantity views">visibility</i>
					<span class="post-info-text">7</span>
				</span>
				</div>
				<div class="col s3 right-align">
					<?= Html::a(
						'Read more',
						['/note/' . $model->alias],
						['class' => 'waves-effect']
					) ?>
				</div>

			</div>
		</div>
	</div>
</div>
