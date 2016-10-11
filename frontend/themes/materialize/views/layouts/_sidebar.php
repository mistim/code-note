<?php

use common\models\Category;
use common\models\Tag;
use yii\helpers\Html;
use frontend\helpers\ViewTools;

/** @var \common\models\Category[] $categories */
/** @var \common\models\Tag[] $tags */

$categories = Category::getAllActive(true);
$tags = Tag::getAllActive(true);
?>

<div class="card">
	<div class="card-title">
		<?= Yii::t('app', 'Categories') ?>
	</div>
	<div class="card-content">
		<div class="col-inline">
			<div class="col s12 without-padding">
				<ul class="tabs">
					<li class="tab col s3">
						<a class="<?= ViewTools::isActiveRoute('site') ?> blue-grey-text text-darken-2" href="#categoryAll">
							<?= Yii::t('app', 'All') ?>
						</a>
					</li>
					<li class="tab col s3">
						<a class="<?= ViewTools::isActiveRoute('post') ?> blue-grey-text text-darken-2" href="#categoryPosts">
							<?= Yii::t('app', 'Posts') ?>
						</a>
					</li>
					<li class="tab col s3">
						<a class="<?= ViewTools::isActiveRoute('note') ?> blue-grey-text text-darken-2" href="#categoryNotes">
							<?= Yii::t('app', 'Notes') ?>
						</a>
					</li>
				</ul>
			</div>
			<div id="categoryAll" class="col s12">
				<ul>
					<?php foreach ($categories as $category): ?>

						<li class="col-inline">
							<span class="left"><?= Html::a($category->title, ['/category/' . $category->alias]) ?></span>
							<span class="right">
								<?= $category->countPosts('_all_' . $category->alias) + $category->countNotes('_all_' . $category->alias) ?>
							</span>
						</li>

					<?php endforeach; ?>
				</ul>
			</div>
			<div id="categoryPosts" class="col s12">
				<ul>
					<?php foreach ($categories as $category): ?>

						<li class="col-inline">
							<span class="left"><?= Html::a($category->title, ['/post/category/' . $category->alias]) ?></span>
							<span class="right"><?= $category->countPosts('_post_' . $category->alias) ?></span>
						</li>

					<?php endforeach; ?>
				</ul>
			</div>
			<div id="categoryNotes" class="col s12">
				<ul>
					<?php foreach ($categories as $category): ?>

						<li class="col-inline">
							<span class="left"><?= Html::a($category->title, ['/note/category/' . $category->alias]) ?></span>
							<span class="right"><?= $category->countNotes('_note_' . $category->alias) ?></span>
						</li>

					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
</div>
<div class="card">
	<div class="card-title">
		<?= Yii::t('app', 'Tags') ?>
	</div>
	<div class="card-content">
		<div class="col-inline">
			<div class="col s12 without-padding">
				<ul class="tabs">
					<li class="tab col s3">
						<a class="<?= ViewTools::isActiveRoute('site') ?> blue-grey-text text-darken-2" href="#tagAll">
							<?= Yii::t('app', 'All') ?>
						</a>
					</li>
					<li class="tab col s3">
						<a class="<?= ViewTools::isActiveRoute('post') ?> blue-grey-text text-darken-2" href="#tagPosts">
							<?= Yii::t('app', 'Posts') ?>
						</a>
					</li>
					<li class="tab col s3">
						<a class="<?= ViewTools::isActiveRoute('note') ?> blue-grey-text text-darken-2" href="#tagNotes">
							<?= Yii::t('app', 'Notes') ?>
						</a>
					</li>
				</ul>
			</div>
			<div id="tagAll" class="col s12">
				<ul>
					<?php foreach ($tags as $tag): ?>

						<li class="col-inline">
							<span class="left"><?= Html::a($tag->title, ['/tag/' . $tag->alias]) ?></span>
							<span class="right">
								<?= $tag->countPosts('_all_' . $tag->alias) + $tag->countNotes('_all_' . $tag->alias) ?>
							</span>
						</li>

					<?php endforeach; ?>
				</ul>
			</div>
			<div id="tagPosts" class="col s12">
				<ul>
					<?php foreach ($tags as $tag): ?>

						<li class="col-inline">
							<span class="left"><?= Html::a($tag->title, ['/post/tag/' . $tag->alias]) ?></span>
							<span class="right"><?= $tag->countPosts('_post_' . $tag->alias) ?></span>
						</li>

					<?php endforeach; ?>
				</ul>
			</div>
			<div id="tagNotes" class="col s12">
				<ul>
					<?php foreach ($tags as $tag): ?>

						<li class="col-inline">
							<span class="left"><?= Html::a($tag->title, ['/note/tag/' . $tag->alias]) ?></span>
							<span class="right"><?= $tag->countNotes('_note_' . $tag->alias) ?></span>
						</li>

					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
</div>
