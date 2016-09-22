<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use backend\models\User;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin([
        'id'     => 'user-form',
        'layout' => 'horizontal',
    ]); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => 32, 'autocomplete' => 'off']) ?>

    <?= $form->field($model, 'email')->input('email', ['autocomplete' => 'off']) ?>

    <?= $form->field($model, 'status')->checkbox([
        'template' => "{label}<div class='col-sm-6'>\n{input}\n{error}\n{hint}</div>"
    ])
        ->label(null, ['class' => 'control-label col-sm-3']) ?>

    <?= $form->field($model, 'password')->passwordInput(['value'=>'', 'maxlength' => 64, 'autocomplete' => 'off']) ?>

    <?= $form->field($model, 'confirm_password')->passwordInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'list_roles')->dropDownList(
        ArrayHelper::map(User::getAllRoles(), 'name', 'name'),
        [
            //'multiple' => true
        ]
    ) ?>

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
