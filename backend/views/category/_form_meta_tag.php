<?php

/* @var $this yii\web\View */
/* @var $meta_tag common\models\MetaTag */
/* @var $form yii\bootstrap\ActiveForm */

$template = "{label}\n{beginWrapper}\n{input}\n<div>"
."<span class=\"char-total\">".Yii::t('admin', 'Total characters').": <strong><span class=\"cnt-char-total\"></span></strong>"."</span>"
."<span class=\"word-total\">".Yii::t('admin', 'Total words').": <strong><span class=\"cnt-word-total\"></span></strong>"."</span>"
."<span class=\"char-left\">".Yii::t('admin', 'Characters left').": <strong><span class=\"cnt-char-left\"></span></strong>"."</span>"
."</div>\n{hint}\n{error}\n{endWrapper}";
?>

<?= $form->field($meta_tag, 'status')->checkbox([
	'template' => "{label}<div class='col-sm-6'>\n{input}\n{error}\n{hint}</div>"
])
	->label(null, ['class' => 'control-label col-sm-3']) ?>

<?= $form->field($meta_tag, 'title')->textInput(['maxlength' => true]) ?>

<?= $form->field($meta_tag, 'key', [
	'template' => $template,
])->textarea(['maxlength' => true, 'rows' => 3, 'class' => 'form-control char_counter']) ?>

<?= $form->field($meta_tag, 'description', [
	'template' => $template,
])->textarea(['maxlength' => true, 'rows' => 6, 'class' => 'form-control char_counter']) ?>
