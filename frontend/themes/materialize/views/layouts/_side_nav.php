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

<ul id="slide-out" class="mobile-sade side-nav">
	<div class="row">

		<div class="card">
			<div class="card-title">
				Categories
			</div>
			<div class="card-content">
				<div class="col-inline">
					<div class="col s12 without-padding">
						<ul class="tabs">
							<li class="tab col s3">
								<a class="<?= ViewTools::isActiveRoute('site') ?> blue-grey-text text-darken-2" href="#categoryAllSB">
									All
								</a>
							</li>
							<li class="tab col s3">
								<a class="<?= ViewTools::isActiveRoute('post') ?> blue-grey-text text-darken-2" href="#categoryPostsSB">
									Posts
								</a>
							</li>
							<li class="tab col s3">
								<a class="<?= ViewTools::isActiveRoute('note') ?> blue-grey-text text-darken-2" href="#categoryNotesSB">
									Notes
								</a>
							</li>
						</ul>
					</div>
					<div id="categoryAllSB" class="col s12">
						<ul>
							<?php foreach ($categories as $category): ?>

								<li class="col-inline">
									<span class="left"><?= Html::a($category->title, ['/category/' . $category->alias]) ?></span>
									<span class="right"><?= $category->getPosts()->count() + $category->getNotes()->count() ?></span>
								</li>

							<?php endforeach; ?>
						</ul>
					</div>
					<div id="categoryPostsSB" class="col s12">
						<ul>
							<?php foreach ($categories as $category): ?>

								<li class="col-inline">
									<span class="left"><?= Html::a($category->title, ['/post/category/' . $category->alias]) ?></span>
									<span class="right"><?= $category->getPosts()->count() ?></span>
								</li>

							<?php endforeach; ?>
						</ul>
					</div>
					<div id="categoryNotesSB" class="col s12">
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
								<a class="<?= ViewTools::isActiveRoute('site') ?> blue-grey-text text-darken-2" href="#tagAllSB">
									All
								</a>
							</li>
							<li class="tab col s3">
								<a class="<?= ViewTools::isActiveRoute('post') ?> blue-grey-text text-darken-2" href="#tagPostsSB">
									Posts
								</a>
							</li>
							<li class="tab col s3">
								<a class="<?= ViewTools::isActiveRoute('note') ?> blue-grey-text text-darken-2" href="#tagNotesSB">
									Notes
								</a>
							</li>
						</ul>
					</div>
					<div id="tagAllSB" class="col s12">
						<ul>
							<?php foreach ($tags as $tag): ?>

								<li class="col-inline">
									<span class="left"><?= Html::a($tag->title, ['/tag/' . $tag->alias]) ?></span>
									<span class="right"><?= $tag->getPosts()->count() + $tag->getNotes()->count() ?></span>
								</li>

							<?php endforeach; ?>
						</ul>
					</div>
					<div id="tagPostsSB" class="col s12">
						<ul>
							<?php foreach ($tags as $tag): ?>

								<li class="col-inline">
									<span class="left"><?= Html::a($tag->title, ['/post/tag/' . $tag->alias]) ?></span>
									<span class="right"><?= $tag->getPosts()->count() ?></span>
								</li>

							<?php endforeach; ?>
						</ul>
					</div>
					<div id="tagNotesSB" class="col s12">
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
</ul>