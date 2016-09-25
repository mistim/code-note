<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Tabs;

/* @var $this yii\web\View */
/* @var $model common\models\Note */
/* @var $meta_tag common\models\MetaTag */
/* @var $form yii\bootstrap\ActiveForm */

$this->registerJsFile('@web/js/char_counter.js', ['depends' => 'yii\web\JqueryAsset']);
?>

<div class="note-form">

    <?php $form = ActiveForm::begin([
        'id' => 'note-form',
        'layout' => 'horizontal',
    ]); ?>

    <div class="nav-tabs-custom">
        <?= Tabs::widget([
            'items' => [
                [
                    'label'   => Yii::t('admin', 'Content'),
                    'content' => $this->render('_form_model', [
                        'form'  => $form,
                        'model' => $model,
                    ]),
                    'active'  => true,
                ],
                [
                    'label'   => Yii::t('admin', 'Meta tags'),
                    'content' => $this->render('_form_meta_tag', [
                        'form'     => $form,
                        'meta_tag' => $meta_tag,
                    ]),
                ],
            ],
        ]); ?>

        <div class="tab-footer">
            <div class="form-group">
                <div class="col-sm-6 col-sm-offset-3">
                    <?= Html::submitButton($model->isNewRecord ? Yii::t('admin', 'Create') : Yii::t('admin', 'Update'), [
                        'class' => $model->isNewRecord ? 'btn btn-flat btn-success' : 'btn btn-flat btn-primary',
                    ]) ?>
                    <?php if ($model->isNewRecord): ?>
                        <?= Html::resetButton(Yii::t('admin', 'Reset'), ['class' => 'btn btn-flat btn-warning']) ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
