<?php

use yii\helpers\Html;
use backend\widgets\Box;
use backend\widgets\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\MetaTagSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('admin', 'Meta-tags');
$this->params['breadcrumbs'][] = $this->title;

$gridId = 'meta-tag-grid';
$gridConfig = [
    'id' => $gridId,
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        'id',
        'entity',
        [
            'class' => '\backend\widgets\grid\ICheckColumn',
            'attribute' => 'status',
            'modelName' => 'MetaTag',
            'route' => Url::to(['/meta-tag/status']),
        ],
        'link',
        'title',
        //'keyword',
        //'description',
    ],
];

$showActions = true;
$actions = [];

if (Yii::$app->user->can('/meta-tag/view')) {
    $actions[] = '{view}';
    $showActions = $showActions || true;
}

if (Yii::$app->user->can('/meta-tag/update')) {
    $actions[] = '{update}';
    $showActions = $showActions || true;
}

if (Yii::$app->user->can('/meta-tag/delete')) {
    $actions[] = '{delete}';
    $showActions = $showActions || true;
}

if ($showActions === true) {
    $gridConfig['columns'][] = [
        'class'    => ActionColumn::className(),
        'template' => implode(' ', $actions),
        'contentOptions' => [
            'align' => 'center',
            'width' => '100px'
        ]
    ];
}
?>

<div class="meta-tag-index">

    <p>
        <?= Html::a(Yii::t('admin', 'Create'), ['create'], ['class' => 'btn btn-flat btn-success']) ?>
    </p>


    <div class="row">
        <div class="col-xs-12">
            <?php Box::begin(
                [
                    'bodyOptions' => [
                        'class' => 'table-responsive'
                    ],
                    'grid' => $gridId
                ]
            ); ?>
            <?= GridView::widget($gridConfig); ?>
            <?php Box::end(); ?>
        </div>
    </div>


</div>
