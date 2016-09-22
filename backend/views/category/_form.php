<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin([
        'id' => 'category-form',
        'layout' => 'horizontal',
    ]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'teaser')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'creator_id')->textInput() ?>

    <?= $form->field($model, 'editor_id')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>


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
