<?php
use yii\bootstrap\ActiveForm;
use backend\models\form\ExcelExchangeForm;

/** @var $model ExcelExchangeForm */
/* @var $form yii\bootstrap\ActiveForm */

$model = new ExcelExchangeForm(['scenario' => 'export']);
?>

<div class="modal fade text-left" id="export-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <?php $form = ActiveForm::begin([
                            'id'     => 'export-form',
                            'layout' => 'horizontal',
                        ]); ?>

                        <?= $form->field($model, 'is_rewrite')
                            ->checkbox([
                                'template' => "{label}<div class='col-sm-6'>\n{input}\n{error}\n{hint}</div>"
                            ])
                            ->label(null, ['class' => 'control-label col-sm-3']) ?>

                        <?= $form->field($model, 'file')->fileInput() ?>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-flat btn-flat btn-default pull-left" data-dismiss="modal"><?= Yii::t('app', 'Cancel') ?></button>
                <button type="submit" class="btn btn-flat btn-flat btn-primary anti-dc" form="export-form"><?= Yii::t('app', 'Run') ?></button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
