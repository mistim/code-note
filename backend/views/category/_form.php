<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use dosamigos\tinymce\TinyMce;
use yii\helpers\Url;
use backend\widgets\imperavi\Widget;

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin([
        'id' => 'category-form',
        'layout' => 'horizontal',
    ]); ?>

    <?= $form->field($model, 'status')->checkbox([
        'template' => "{label}<div class='col-sm-6'>\n{input}\n{error}\n{hint}</div>"
    ])
        ->label(null, ['class' => 'control-label col-sm-3']) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

    <?= '';//$form->field($model, 'teaser')->textarea(['maxlength' => true]) ?>

    <?= '';//$form->field($model, 'teaser')->widget(TinyMce::className()) ?>

    <?= $form->field($model, 'teaser')->widget(Widget::className(), [
        'settings' => [
            'lang'             => 'ru',
            'minHeight'        => 210,
            'imageManagerJson' => Url::to(['uploader/image-get']),
            'imageUpload'      => Url::to(['uploader/image-upload']),
            'fileManagerJson'  => Url::to(['uploader/file-get']),
            'fileUpload'       => Url::to(['uploader/file-upload']),
            'plugins'          => [
                'fullscreen',
                'clips',
                'table',
                'imagemanager',
                'filemanager'
            ]
        ]
    ])->textarea(['class' => 'redactor']) ?>

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
