<?php

use yii\helpers\Html;
use yii\bootstrap\Tabs;

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $meta_tag common\models\MetaTag */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('admin', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-view">

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

    <div class="nav-tabs-custom">
        <?= Tabs::widget([
            'items' => [
                [
                    'label'   => Yii::t('admin', 'Content'),
                    'content' => $this->render('_view_model', [
                        'model' => $model,
                    ]),
                    'active'  => true,
                ],
                [
                    'label'   => Yii::t('admin', 'Meta tags'),
                    'content' => $this->render('_view_meta_tag', [
                        'meta_tag' => $model->meta_tag,
                    ]),
                ],
            ],
        ]); ?>
    </div>

</div>
