<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\widgets\Box;
use backend\helpers\ToolsHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Note */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('admin', 'Notes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="note-view">

    <p>
        <?= Html::a(Yii::t('admin', 'Back to list'), ['index'], ['class' => 'btn btn-flat btn-info']) ?>
        <?= Html::a(Yii::t('admin', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-flat btn-primary']) ?>
        <?= Html::a(Yii::t('admin', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-flat btn-danger',
            'data' => [
                'confirm' => Yii::t('admin', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="row">
        <div class="col-xs-12">
            <?php Box::begin(
                [
                    //'options'     => ['class' => 'box-success'],
                    'bodyOptions' => [
                        'class' => 'table-responsive'
                    ],
                ]
            ); ?>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'title',
                    'alias',
                    [
                        'attribute' => 'status',
                        'format' => 'html',
                        'value' => ToolsHelper::getStatusStr($model->status)
                    ],
                    'posted_at:datetime',
                    'creator.username',
                    'editor.username',
                    'created_at:datetime',
                    'updated_at:datetime',
                    'teaser:html',
                    'content:html',
                ],
            ]) ?>
            <?php Box::end(); ?>
        </div>
    </div>

</div>
