<?php

use common\models\Category;
use yii\helpers\Html;

/** @var \common\models\Category $categories */

$categories = Category::getAllActive();
?>

<div class="sidebar">
	<div class="hide-on-med-and-down bar-top">
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
		<div class="widget card">
			<div class="card-content">
				<div class="card-title">
					<span class="badge-block z-depth-0 blue-grey darken-3 white-text">
						<i class="badge-icon material-icons">library_books</i>
					</span> Categories
				</div>
				<div class="col-inline">
					<div class="col s12 without-padding">
						<ul class="tabs">
							<li class="tab col s3">
								<a class="active blue-grey-text text-darken-2" href="#test1">All</a>
							</li>
							<li class="tab col s3">
								<a class="blue-grey-text text-darken-2" href="#test2">Posts</a>
							</li>
							<li class="tab col s3">
								<a class="blue-grey-text text-darken-2" href="#test3">Tags</a>
							</li>
						</ul>
					</div>
					<div id="test1" class="col s12">
						<ul>
							<?php foreach ($categories as $category): ?>

								<li>
									<span class="left"><?= Html::a($category->title, ['#']) ?></span>
									<span class="right"><?= $category->getPosts()->count() + $category->getNotes()->count() ?></span>
								</li>

							<?php endforeach; ?>
						</ul>
					</div>
					<div id="test2" class="col s12">
						<ul>
							<?php foreach ($categories as $category): ?>

								<li>
									<span class="left"><?= Html::a($category->title, ['#']) ?></span>
									<span class="right"><?= $category->getPosts()->count() ?></span>
								</li>

							<?php endforeach; ?>
						</ul>
					</div>
					<div id="test3" class="col s12">
						<ul>
							<?php foreach ($categories as $category): ?>

								<li>
									<span class="left"><?= Html::a($category->title, ['#']) ?></span>
									<span class="right"><?= $category->getNotes()->count() ?></span>
								</li>

							<?php endforeach; ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="widget card">
			<div class="card-content">
				<div class="card-title">
					<span class="badge-block z-depth-0 blue-grey darken-3 white-text">
						<i class="badge-icon material-icons">style</i>
					</span> Tags
				</div>
				<p>I am a very simple card. I am good at containing small bits of information.
					I am convenient because I require little markup to use effectively.</p>
			</div>
		</div>
	</div>
</div>
