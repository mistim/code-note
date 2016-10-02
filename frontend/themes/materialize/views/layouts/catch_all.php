<?php

/* @var $this \yii\web\View */
/* @var $content string */

?>

<?php $this->beginPage() ?>
	<!DOCTYPE html>
	<html lang="<?= Yii::$app->language ?>">
	<head>
		<?= $this->render('_head') ?>
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
				</div>
			</div>
		</nav>
	</header>

	<main>
		<div class="container">
			<div class="row">
				<div class="col s12">
					<div class="main-content">
						<?= $content ?>
					</div>
				</div>
			</div>
		</div>
	</main>

	<?= $this->render('_footer') ?>

	<?= $this->render('_side_nav') ?>

	<?php $this->endBody() ?>
	</body>
	</html>
<?php $this->endPage() ?>