<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SourceMessage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="message-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'translation_en')->textarea(['rows' => 5]) ?>
    <?= $form->field($model, 'translation_uk')->textarea(['rows' => 5]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('admin', 'Create') : Yii::t('admin', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-flat btn-success' : 'btn btn-flat btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
