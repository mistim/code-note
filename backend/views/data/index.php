<?php

use backend\widgets\Box;
use yii\helpers\Html;

?>

<div class="row">
    <div class="col-sm-12">
        <?php Box::begin(
            [
                'title' => Yii::t('admin', 'Data cleaning'),
                'bodyOptions' => [
                    'class' => 'table-responsive'
                ],
                'grid' => 'order-chart'
            ]
        ); ?>
        <div class="col-md-3">
            <div class="data-link">
                <h4>
                    <?= Html::a(
                        Html::tag('i', null, ['class' => 'fa fa-trash']) . Yii::t('admin', 'Delete cache'),
                        ['delete-cache'],
                        [
                            'class'       => 'btn btn-block btn-flat btn-warning btn-lg anti-dc',
                            'data-method' => 'post'
                        ]
                    ) ?>
                </h4>
            </div>
            <div class="data-link">
                <h4>
                    <?= Html::a(
                        Html::tag('i', null, ['class' => 'fa fa-trash']) . Yii::t('admin', 'Clear Twig cache'),
                        ['delete-twig-cache'],
                        [
                            'class'       => 'btn btn-block btn-flat btn-warning btn-lg anti-dc',
                            'data-method' => 'post'
                        ]
                    ) ?>
                </h4>
            </div>
            <div class="data-link">
                <h4>
                    <?= Html::a(
                        Html::tag('i', null, ['class' => 'fa fa-trash']) . Yii::t('admin', 'Clear assets'),
                        ['delete-assets'],
                        [
                            'class'       => 'btn btn-block btn-flat btn-warning btn-lg anti-dc',
                            'data-method' => 'post'
                        ]
                    ) ?>
                </h4>
            </div>
        </div>
        <?php Box::end(); ?>
    </div>
</div>
