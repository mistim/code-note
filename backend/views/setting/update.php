<?php

use yii\helpers\Html;
use backend\widgets\Box;

/* @var $this yii\web\View */
/* @var $model common\models\Setting */

$this->title = Yii::t('admin', 'Update {modelClass}: ', [
    'modelClass' => 'Setting',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('admin', 'Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('admin', 'Update');
?>
<div class="setting-update">

    <p>
        <?= Html::a(Yii::t('admin', 'Back to list'), ['index'], ['class' => 'btn btn-flat btn-info']) ?>
    </p>

    <div class="row">
        <div class="col-xs-12">
            <?php Box::begin(
                [
                    'options'     => ['class' => 'box-success'],
                    'bodyOptions' => [
                        'class' => 'table-responsive'
                    ],
                ]
            ); ?>
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
            <?php Box::end(); ?>
        </div>
    </div>

</div>
