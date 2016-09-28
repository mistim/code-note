<?php

use yii\helpers\Url;
use backend\widgets\imperavi\Widget;

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $form yii\bootstrap\ActiveForm */

$template = "{label}\n{beginWrapper}\n{input}\n<div class='chars-info'>"
	. "<span class=\"char-total\">" . Yii::t('admin', 'Total characters') . ": <strong><span class=\"cnt-char-total\"></span></strong>" . "</span>"
	. "<span class=\"word-total\">" . Yii::t('admin', 'Total words') . ": <strong><span class=\"cnt-word-total\"></span></strong>" . "</span>"
	. "<span class=\"char-left\">" . Yii::t('admin', 'Characters left') . ": <strong><span class=\"cnt-char-left\"></span></strong>" . "</span>"
	. "</div>\n{hint}\n{error}\n{endWrapper}";
?>

<?= $form->field($model, 'status')->checkbox([
	'template' => "{label}<div class='col-sm-6'>\n{input}\n{error}\n{hint}</div>",
])
	->label(null, ['class' => 'control-label col-sm-3']) ?>

<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

<?= '';//$form->field($model, 'teaser')->textarea(['maxlength' => true])  ?>

<?= '';//$form->field($model, 'teaser')->widget(TinyMce::className())  ?>

<?= $form->field($model, 'teaser', [
	'template' => $template,
])
	->widget(Widget::className())
	->textarea(['class' => 'redactor char_counter', 'maxlength' => true]) ?>
