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

<ul id="slide-out" class="mobile-sade side-nav">
	<div class="row">

		<div class="card">
			<div class="card-title">
				<?= Yii::t('app', 'Categories') ?>: <span class="title-entity">
					<span data-id="#categoryAllSB" class="<?= ViewTools::notHide('site', 'category', 'tag') ?>"><?= Yii::t('app', 'all') ?></span>
					<span data-id="#categoryPostsSB" class="<?= ViewTools::notHide('post') ?>"><?= Yii::t('app', 'posts') ?></span>
					<span data-id="#categoryNotesSB" class="<?= ViewTools::notHide('note') ?>"><?= Yii::t('app', 'notes') ?></span>
				</span>
			</div>
			<div class="card-content">
				<div class="col-inline">
					<div class="col s12 without-padding">
						<ul class="tabs">
							<li class="tab">
								<a class="<?= ViewTools::isActiveRoute('site') ?> blue-grey-text text-darken-2" href="#categoryAllSB">
									<i class="material-icons dp48">view_module</i>
								</a>
							</li>
							<li class="tab">
								<a class="<?= ViewTools::isActiveRoute('post') ?> blue-grey-text text-darken-2" href="#categoryPostsSB">
									<i class="material-icons dp48">view_list</i>
								</a>
							</li>
							<li class="tab">
								<a class="<?= ViewTools::isActiveRoute('note') ?> blue-grey-text text-darken-2" href="#categoryNotesSB">
									<i class="material-icons dp48">reorder</i>
								</a>
							</li>
						</ul>
					</div>
					<div id="categoryAllSB" class="col s12">
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
					<div id="categoryPostsSB" class="col s12">
						<ul>
							<?php foreach ($categories as $category): ?>

								<li class="col-inline">
									<span class="left"><?= Html::a($category->title, ['/post/category/' . $category->alias]) ?></span>
									<span class="right"><?= $category->countPosts('_post_' . $category->alias) ?></span>
								</li>

							<?php endforeach; ?>
						</ul>
					</div>
					<div id="categoryNotesSB" class="col s12">
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
				<?= Yii::t('app', 'Tags') ?>: <span class="title-entity">
					<span data-id="#tagAllSB" class="<?= ViewTools::notHide('site', 'category', 'tag') ?>"><?= Yii::t('app', 'all') ?></span>
					<span data-id="#tagPostsSB" class="<?= ViewTools::notHide('post') ?>"><?= Yii::t('app', 'posts') ?></span>
					<span data-id="#tagNotesSB" class="<?= ViewTools::notHide('note') ?>"><?= Yii::t('app', 'notes') ?></span>
				</span>
			</div>
			<div class="card-content">
				<div class="col-inline">
					<div class="col s12 without-padding">
						<ul class="tabs">
							<li class="tab">
								<a class="<?= ViewTools::isActiveRoute('site') ?> blue-grey-text text-darken-2" href="#tagAllSB">
									<i class="material-icons dp48">view_module</i>
								</a>
							</li>
							<li class="tab ">
								<a class="<?= ViewTools::isActiveRoute('post') ?> blue-grey-text text-darken-2" href="#tagPostsSB">
									<i class="material-icons dp48">view_list</i>
								</a>
							</li>
							<li class="tab">
								<a class="<?= ViewTools::isActiveRoute('note') ?> blue-grey-text text-darken-2" href="#tagNotesSB">
									<i class="material-icons dp48">reorder</i>
								</a>
							</li>
						</ul>
					</div>
					<div id="tagAllSB" class="col s12">
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
					<div id="tagPostsSB" class="col s12">
						<ul>
							<?php foreach ($tags as $tag): ?>

								<li class="col-inline">
									<span class="left"><?= Html::a($tag->title, ['/post/tag/' . $tag->alias]) ?></span>
									<span class="right"><?= $tag->countPosts('_post_' . $tag->alias) ?></span>
								</li>

							<?php endforeach; ?>
						</ul>
					</div>
					<div id="tagNotesSB" class="col s12">
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

	</div>
</ul>
