<?php

use yii\helpers\Html;
use backend\widgets\Box;

/* @var $this yii\web\View */
/* @var $model common\models\Message */

$this->title = Yii::t('admin', 'Update record') . ' № ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('admin', 'Messages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('admin', 'Update');
?>
<div class="message-update">
	<p>
        <?= Html::a(Yii::t('admin', 'Back to list'), ['index'], ['class' => 'btn btn-flat btn-info']) ?>
    </p>

    <div class="row">
        <div class="col-xs-12">
            <?php Box::begin(
                [
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

