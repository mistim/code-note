<?php

use common\models\Category;
use common\models\Tag;
use yii\helpers\Html;
use frontend\helpers\ViewTools;

/** @var \common\models\Category[] $categories */
/** @var \common\models\Tag[] $tags */

$categories = Category::getAllActive();
$tags = Tag::getAllActive();
?>

<div class="sidebar">
	<div class="hide-on-med-and-down bar-top">
		<!--
		<div class="widget card">
			<div class="card-content">
				<div class="card-title">
					<span class="badge-block z-depth-0 blue-grey darken-3 white-text">
						<i class="badge-icon material-icons">library_books</i>
					</span> Categories
				</div>
				<ul class="collapsible z-depth-0" data-collapsible="accordion">
					<li>
						<div class="collapsible-header active">All</div>
						<div class="collapsible-body">
							<ul class="col-inline">
								<?php foreach ($categories as $category): ?>

									<li>
										<span class="left"><?= Html::a($category->title, ['#']) ?></span>
										<span class="right"><?= $category->getPosts()->count() + $category->getNotes()->count() ?></span>
									</li>

								<?php endforeach; ?>
							</ul>
						</div>
					</li>
					<li>
						<div class="collapsible-header">Posts</div>
						<div class="collapsible-body">
							<ul class="col-inline">
								<?php foreach ($categories as $category): ?>

									<li>
										<span class="left"><?= Html::a($category->title, ['#']) ?></span>
										<span class="right"><?= $category->getPosts()->count() ?></span>
									</li>

								<?php endforeach; ?>
							</ul>
						</div>
					</li>
					<li>
						<div class="collapsible-header">Notes</div>
						<div class="collapsible-body">
							<ul class="col-inline">
								<?php foreach ($categories as $category): ?>

									<li>
										<span class="left"><?= Html::a($category->title, ['#']) ?></span>
										<span class="right"><?= $category->getNotes()->count() ?></span>
									</li>

								<?php endforeach; ?>
							</ul>
						</div>
					</li>
				</ul>
			</div>
		</div>
		-->
		<div class="card">
			<div class="card-title">
				Categories
			</div>
			<div class="card-content">
				<div class="col-inline">
					<div class="col s12 without-padding">
						<ul class="tabs">
							<li class="tab col s3">
								<a class="<?= ViewTools::isActiveRoute('site') ?> blue-grey-text text-darken-2" href="#categoryAll">
									All
								</a>
							</li>
							<li class="tab col s3">
								<a class="<?= ViewTools::isActiveRoute('post') ?> blue-grey-text text-darken-2" href="#categoryPosts">
									Posts
								</a>
							</li>
							<li class="tab col s3">
								<a class="<?= ViewTools::isActiveRoute('note') ?> blue-grey-text text-darken-2" href="#categoryNotes">
									Notes
								</a>
							</li>
						</ul>
					</div>
					<div id="categoryAll" class="col s12">
						<ul>
							<?php foreach ($categories as $category): ?>

								<li class="col-inline">
									<span class="left"><?= Html::a($category->title, ['/category/' . $category->alias]) ?></span>
									<span class="right"><?= $category->getPosts()->count() + $category->getNotes()->count() ?></span>
								</li>

							<?php endforeach; ?>
						</ul>
					</div>
					<div id="categoryPosts" class="col s12">
						<ul>
							<?php foreach ($categories as $category): ?>

								<li class="col-inline">
									<span class="left"><?= Html::a($category->title, ['/post/category/' . $category->alias]) ?></span>
									<span class="right"><?= $category->getPosts()->count() ?></span>
								</li>

							<?php endforeach; ?>
						</ul>
					</div>
					<div id="categoryNotes" class="col s12">
						<ul>
							<?php foreach ($categories as $category): ?>

								<li class="col-inline">
									<span class="left"><?= Html::a($category->title, ['/note/category/' . $category->alias]) ?></span>
									<span class="right"><?= $category->getNotes()->count() ?></span>
								</li>

							<?php endforeach; ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-title">
				Tags
			</div>
			<div class="card-content">
				<div class="col-inline">
					<div class="col s12 without-padding">
						<ul class="tabs">
							<li class="tab col s3">
								<a class="<?= ViewTools::isActiveRoute('site') ?> blue-grey-text text-darken-2" href="#tagAll">
									All
								</a>
							</li>
							<li class="tab col s3">
								<a class="<?= ViewTools::isActiveRoute('post') ?> blue-grey-text text-darken-2" href="#tagPosts">
									Posts
								</a>
							</li>
							<li class="tab col s3">
								<a class="<?= ViewTools::isActiveRoute('note') ?> blue-grey-text text-darken-2" href="#tagNotes">
									Notes
								</a>
							</li>
						</ul>
					</div>
					<div id="tagAll" class="col s12">
						<ul>
							<?php foreach ($tags as $tag): ?>

								<li class="col-inline">
									<span class="left"><?= Html::a($tag->title, ['/tag/' . $tag->alias]) ?></span>
									<span class="right"><?= $tag->getPosts()->count() + $tag->getNotes()->count() ?></span>
								</li>

							<?php endforeach; ?>
						</ul>
					</div>
					<div id="tagPosts" class="col s12">
						<ul>
							<?php foreach ($tags as $tag): ?>

								<li class="col-inline">
									<span class="left"><?= Html::a($tag->title, ['/post/tag/' . $tag->alias]) ?></span>
									<span class="right"><?= $tag->getPosts()->count() ?></span>
								</li>

							<?php endforeach; ?>
						</ul>
					</div>
					<div id="tagNotes" class="col s12">
						<ul>
							<?php foreach ($tags as $tag): ?>

								<li class="col-inline">
									<span class="left"><?= Html::a($tag->title, ['/note/tag/' . $tag->alias]) ?></span>
									<span class="right"><?= $tag->getNotes()->count() ?></span>
								</li>

							<?php endforeach; ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
