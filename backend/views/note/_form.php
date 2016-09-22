<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use backend\widgets\imperavi\Widget;
use common\models\Category;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Note */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="note-form">

    <?php $form = ActiveForm::begin([
        'id' => 'note-form',
        'layout' => 'horizontal',
    ]); ?>

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

    <?= $form->field($model, 'content')->widget(Widget::className(), [
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
            'class' => $model->isNewRecord ? 'btn btn-flat btn-success' : 'btn btn-flat btn-primary'
        ]) ?>
        <?php if ($model->isNewRecord): ?>
            <?= Html::resetButton(Yii::t('admin', 'Reset'), ['class' => 'btn btn-flat btn-warning']) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
