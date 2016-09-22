<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Setting */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="setting-form">

    <?php $form = ActiveForm::begin([
        'id' => 'setting-form',
        'layout' => 'horizontal',
    ]); ?>

    <?= $form->field($model, 'status')->checkbox([
        'template' => "{label}<div class='col-sm-6'>\n{input}\n{error}\n{hint}</div>"
    ])
        ->label(null, ['class' => 'control-label col-sm-3']) ?>

    <?= $form->field($model, 'var_key')->textInput(['maxlength' => true, 'readonly' => !$model->isNewRecord]) ?>

    <?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>

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
