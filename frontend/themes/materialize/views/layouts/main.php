<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\assets as Assets;
use yii\widgets\Menu;

Assets\MaterializeAsset::register($this);
Assets\AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<meta charset="<?= Yii::$app->charset ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?= Html::csrfMetaTags() ?>
	<title><?= Html::encode($this->title) ?></title>
	<?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<header class="navbar-fixed">
	<nav class="cyan darken-2">
		<div class="nav-wrapper container">
			<div class="col s12">
				<a href="/" id="logo-container" class="brand-logo">
					&lt;Code/&gt; Note <span class="logo-ln">_</span>
				</a>

				<?= Menu::widget([
					'options' => [
						'class' => 'right hide-on-med-and-down'
					],
					'items' => [
						['label' => 'Posts', 'url' => ['site/index']],
						['label' => 'Notes', 'url' => ['product/index']],
					],
				]); ?>


				<a href="#" data-activates="nav-mobile" class="button-collapse">
					<i class="material-icons">menu</i>
				</a>
			</div>
		</div>
	</nav>
</header>

<main>
	<div class="container">

		<?= $content ?>

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

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>