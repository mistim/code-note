<?php

/** @var $this \yii\web\View */

$js = <<<JS
	$('.parallax').parallax();
JS;

$this->registerJs($js);
?>

<div class="row">
	<!--<div class="parallax-container">
		<div class="parallax"><img src="/images/sample-1.jpg"></div>
	</div>-->
	<div class="col s12">
		<div class="card">
			<div class="card-image">
				<img src="/images/sample-1.jpg">
				<span class="card-title">Card Title</span>
			</div>
			<div class="card-content">
				<p>I am a very simple card. I am good at containing small bits of information.
					I am convenient because I require little markup to use effectively.</p>
			</div>
			<div class="waves card-action">
				<a class="waves-effect" href="#">This is a link</a>
				<a class="waves-effect" href="#">This is a link</a>
			</div>
		</div>
	</div>
</div>