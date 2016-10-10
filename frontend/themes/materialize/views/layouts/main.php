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
<body class="blue-grey lighten-5 hide">
<?php $this->beginBody() ?>

<?= $this->render('_menu') ?>

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

<?= $this->render('_footer') ?>

<?= $this->render('_side_nav') ?>

<div class="go-up fixed-action-btn">
	<a class="btn-floating btn-large deep-orange darken-1 waves-effect">
		<i class="large material-icons">keyboard_arrow_up</i>
	</a>
</div>

<div id="pl-page-wrapper">
	<div id="pl-page">
		<div id="pl-text"><?= Yii::t('app', 'preloader text') ?></div>
		<?= $this->render('/preloader/_1') ?>
	</div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>