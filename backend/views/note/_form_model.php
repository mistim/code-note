<?php

use yii\helpers\Url;
use backend\widgets\imperavi\Widget;
use common\models\Category;
use yii\helpers\ArrayHelper;
use backend\themes\adminlte\assets\Select2Asset;

/* @var $this yii\web\View */
/* @var $model common\models\Note */
/* @var $tags common\models\Tag[] */
/* @var $form yii\bootstrap\ActiveForm */

$template = "{label}\n{beginWrapper}\n{input}\n<div class='chars-info'>"
	. "<span class=\"char-total\">" . Yii::t('admin', 'Total characters') . ": <strong><span class=\"cnt-char-total\"></span></strong>" . "</span>"
	. "<span class=\"word-total\">" . Yii::t('admin', 'Total words') . ": <strong><span class=\"cnt-word-total\"></span></strong>" . "</span>"
	. "<span class=\"char-left\">" . Yii::t('admin', 'Characters left') . ": <strong><span class=\"cnt-char-left\"></span></strong>" . "</span>"
	. "</div>\n{hint}\n{error}\n{endWrapper}";

$this->registerAssetBundle(Select2Asset::className());
$this->registerJs(
	'$("#note-list_tag").select2({
        placeholder: "' . Yii::t('admin', 'Set tag') . '",
        tags: true,
        tokenSeparators: [","],
    });'
);
?>

<?= $form->field($model, 'status')->checkbox([
	'template' => "{label}<div class='col-sm-6'>\n{input}\n{error}\n{hint}</div>"
])
	->label(null, ['class' => 'control-label col-sm-3']) ?>

<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'posted_at')->textInput() ?>

<?= $form->field($model, 'category_id')->dropDownList(
	ArrayHelper::map(Category::getAllActive(), 'id', 'title'),
	['prompt' => 'Choice category']
) ?>

<?= $form->field($model, 'list_tag')
	->dropDownList(ArrayHelper::map($tags, 'title', 'title'), [
        'prompt'   => Yii::t('admin', 'Set tag'),
        'multiple' => true
	]) ?>

<?= $form->field($model, 'teaser', [
	'template' => $template
])
	->widget(Widget::className())
	->textarea(['class' => 'redactor char_counter', 'maxlength' => true]) ?>

<?= $form->field($model, 'text', [
	'template' => "{label}<div class='col-sm-12'>\n{input}\n{error}\n{hint}</div>"
])
	->widget(Widget::className())
	->textarea(['class' => 'redactor']) ?>
