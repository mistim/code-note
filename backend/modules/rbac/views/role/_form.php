<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/**
 * @var yii\web\View $this
 * @var backend\modules\rbac\models\AuthItemModel $model
 * @var yii\bootstrap\ActiveForm $form
 */
?>

<div class="auth-item-form">

    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
    ]); ?>

    <?php echo $form->field($model, 'name')->textInput(['maxlength' => 64]); ?>

    <?php echo $form->field($model, 'description')->textarea(['rows' => 2]); ?>

    <?php echo $form->field($model, 'ruleName')->widget('yii\jui\AutoComplete', [
        'options'       => [
            'class' => 'form-control',
        ],
        'clientOptions' => [
            'source' => array_keys(Yii::$app->authManager->getRules()),
        ]
    ]);
    ?>

    <?php echo $form->field($model, 'data')->textarea(['rows' => 6]); ?>

    <div class="box-footer with-border">
        <div class="col-sm-6 col-sm-offset-3">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('admin', 'Create') : Yii::t('admin', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-flat btn-success' : 'btn btn-flat btn-primary']) ?>
            <?php if ($model->isNewRecord): ?>
                <?= Html::resetButton(Yii::t('admin', 'Reset'), ['class' => 'btn btn-flat btn-warning']) ?>
            <?php endif; ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>