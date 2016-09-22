<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\widgets\Box;
use common\models\Message;

/* @var $this yii\web\View */
/* @var $model common\models\SourceMessage */

$this->title = Yii::t('admin', 'Record') . ' № ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('admin', 'Messages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="message-view">

    <p>
	    <?= Html::a(Yii::t('admin', 'Back to list'), ['index'], ['class' => 'btn btn-flat btn-info']) ?>
		<?= Yii::$app->user->can('/translation-public/update')
            ? Html::a(Yii::t('admin', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-flat btn-primary'])
            : null ?>
        <?= Yii::$app->user->can('/translation-public/delete')
            ? Html::a(Yii::t('admin', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-flat btn-danger',
            'data' => [
                'confirm' => Yii::t('admin', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) : null ?>
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
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'message',
                    [
                        'label' => 'EN',
                        'value' => Message::getTranslate($model, 'en')
                    ],
                    [
                        'label' => 'UA',
                        'value' => Message::getTranslate($model, 'us')
                    ],
                ],
            ]) ?>
            <?php Box::end(); ?>
        </div>
    </div>

</div>
