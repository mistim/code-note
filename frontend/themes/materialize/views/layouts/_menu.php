<?php

use yii\widgets\Menu;

$controller = Yii::$app->controller;
?>

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