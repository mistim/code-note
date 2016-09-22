<?php

use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\models\form\SearchForm */

$js = <<<JS
	$('select').material_select();
JS;

$this->registerJs($js);
?>

<div class="search-index">
	<h1 class="center-align">Express</h1>

	<div class="row center-align">
		<?php $form = ActiveForm::begin([
			'id' => 'contact-form',
			'fieldConfig' => [
				'options' => [
					'tag'=>'div'
				]
			],
		]); ?>

			<?= $form->field($model, 'query_type', [
				'template' => '<div class="input-field col s3">{input}{label}{error}</div>'
			])->dropDownList($model->getQueryTypeList()) ?>

			<?= $form->field($model, 'query_string', [
				'template' => '<div class="input-field col s7">{input}{label}{error}</div>'
			])->textInput(['placeholder' => 'Enter name']) ?>

			<div class="input-field col s2">
				<button type="submit" class="waves-effect waves-light btn">Send</button>
			</div>

		<?php ActiveForm::end(); ?>
	</div>
</div>
