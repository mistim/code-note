<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\assets as Assets;
use yii\widgets\Menu;

Assets\MaterializeAsset::register($this);
Assets\AppAsset::register($this);

$controller = Yii::$app->controller;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<meta charset="<?= Yii::$app->charset ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?= Html::csrfMetaTags() ?>
	<title><?= Html::encode($this->params['title']) ?></title>
	<meta name="keywords" content="<?= Html::encode($this->params['keywords']) ?>" />
	<meta name="description" content="<?= Html::encode($this->params['description']) ?>" />
	<?php $this->head() ?>
</head>
<body class="blue-grey lighten-5">
<?php $this->beginBody() ?>

<header class="navbar-fixed">
	<nav class="cyan darken-2">
		<div class="nav-wrapper container">
			<div class="col s12">
				<a href="/" id="logo-container" class="waves-effect brand-logo">
					&lt;Code/&gt; Note <span class="logo-ln">_</span>
				</a>

				<?php $menu_items = [
					['label' => 'Posts', 'url' => ['/post'], 'active' => $controller->id === 'post',],
					['label' => 'Notes', 'url' => ['/note'], 'active' => $controller->id === 'note',],
					//['label' => 'Contacts', 'url' => ['site/contact']],
				]; ?>

				<?= Menu::widget([
					'options' => [
						'class' => 'right hide-on-med-and-down'
					],
					'itemOptions' => [
						'class' => 'waves-effect'
					],
					'items' => $menu_items,
				]); ?>

				<?= Menu::widget([
					'options' => [
						'id' => 'nav-mobile',
						'class' => 'side-nav'
					],
					'itemOptions' => [
						'class' => 'waves-effect col-block'
					],
					'items' => $menu_items,
				]); ?>


				<a href="#" data-activates="nav-mobile" class="button-collapse mobile-menu">
					<i class="material-icons">menu</i>
				</a>
				<a href="#" data-activates="slide-out" class="button-collapse mobile-sidebar right">
					<i class="material-icons">details</i>
				</a>
			</div>
		</div>
	</nav>
</header>

<main>
	<div class="container">
		<div class="row">
			<div class="col s12 l9">
				<div class="main-content">
					<?= $content ?>
				</div>
			</div>
			<div class="col hide-on-med-and-down l3">
				<div class="sidebar">
					<div class="hide-on-med-and-down bar-top">
						<?= $this->render('_sidebar') ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

<footer class="page-footer blue-grey darken-2">
	<div class="container">
		<div class="row white-text">
			&copy; <?= date('Y') ?> Code Note
			<span class="grey-text text-lighten-2 right">
				Powered by: <a class="teal-text text-lighten-3" href="mailto::m.mistim@gmail.com">Mistim</a>
			</span>
		</div>
	</div>
</footer>

<?= $this->render('_side_nav') ?>

<div class="go-up fixed-action-btn">
	<a class="btn-floating btn-large deep-orange darken-1 waves-effect">
		<i class="large material-icons">keyboard_arrow_up
		</i>
	</a>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>