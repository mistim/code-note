<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\MetaTag */
/* @var $form yii\bootstrap\ActiveForm */

$this->registerJsFile('@web/js/char_counter.js', ['depends' => 'yii\web\JqueryAsset']);

$template = "{label}\n{beginWrapper}\n{input}\n<div>"
    ."<span class=\"char-total\">".Yii::t('admin', 'Total characters').": <strong><span class=\"cnt-char-total\"></span></strong>"."</span>"
    ."<span class=\"word-total\">".Yii::t('admin', 'Total words').": <strong><span class=\"cnt-word-total\"></span></strong>"."</span>"
    ."<span class=\"char-left\">".Yii::t('admin', 'Characters left').": <strong><span class=\"cnt-char-left\"></span></strong>"."</span>"
    ."</div>\n{hint}\n{error}\n{endWrapper}";
?>

<div class="meta-tag-form">

    <?php $form = ActiveForm::begin([
        'id' => 'meta-tag-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'horizontalCssClasses' => [
                'label' => 'col-sm-3',
                'offset' => 'col-sm-offset-3',
                'wrapper' => 'col-sm-6',
                'error' => '',
                'hint' => 'col-sm-offset-3 col-sm-6',
            ],
        ],
    ]); ?>

    <?= $form->field($model, 'status')->checkbox([
        'template' => "{label}<div class='col-sm-6'>\n{input}\n{error}\n{hint}</div>"
    ])
        ->label(null, ['class' => 'control-label col-sm-3']) ?>

    <?= $form->field($model, 'entity')->textInput(['maxlength' => true])
        ->hint(Yii::t('admin', 'Example: \common\models\Example'))
        ->inline(false) ?>

    <?= $form->field($model, 'link')->textInput(['maxlength' => true])
        ->hint(Yii::t('admin', 'Enter the address without the domain and location, for example: /about'))
        ->inline(false) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'keyword', [
        'template' => $template,
    ])->textarea(['maxlength' => true, 'rows' => 3, 'class' => 'form-control char_counter']) ?>

    <?= $form->field($model, 'description', [
        'template' => $template,
    ])->textarea(['maxlength' => true, 'rows' => 6, 'class' => 'form-control char_counter']) ?>


    <div class="col-sm-6 col-sm-offset-3">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('admin', 'Create') : Yii::t('admin', 'Update'), [
            'class' => $model->isNewRecord ? 'btn btn-flat btn-success' : 'btn btn-flat btn-primary'
        ]) ?>
        <?php if ($model->isNewRecord): ?>
            <?= Html::resetButton(Yii::t('admin', 'Reset'), ['class' => 'btn btn-flat btn-warning']) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
