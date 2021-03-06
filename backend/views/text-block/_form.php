<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use backend\widgets\imperavi\Widget;
use backend\widgets\fileapi\Widget as FileAPI;

/* @var $this yii\web\View */
/* @var $model common\models\TextBlock */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="text-block-form">

    <?php $form = ActiveForm::begin([
        'id'     => 'text-block-form',
        'layout' => 'horizontal',
    ]); ?>

    <?= $form->field($model, 'status')->checkbox([
        'template' => "{label}<div class='col-sm-6'>\n{input}\n{error}\n{hint}</div>"
    ])
        ->label(null, ['class' => 'control-label col-sm-3']) ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => true, 'readonly' => !$model->isNewRecord]) ?>

    <?= $form->field($model, 'image')->widget(FileAPI::className(),
        [
            'settings' => [
                'url' => ['fileapi-upload'],
            ],
            'jcropSettings' => [
                'bgColor' => '#ffffff',
                //'aspectRatio' => 260/326,
                //'maxSize' => [568, 800],
                //'minSize' => [100, 100],
                'keySupport' => false,
                'selection' => '100%'
            ],
            //'crop' => true,
            //'cropResizeWidth' => 260,
            //'cropResizeHeight' => 326
        ]
    ) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'text')->widget(Widget::className(), [
        'settings' => [
            'lang'             => 'ru',
            'minHeight'        => 400,
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
            'class' => $model->isNewRecord ? 'btn flat btn-success' : 'btn flat btn-primary'
        ]) ?>
        <?php if ($model->isNewRecord): ?>
            <?= Html::resetButton(Yii::t('admin', 'Reset'), ['class' => 'btn flat btn-warning']) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
