<?php

use yii\helpers\Html;
use backend\widgets\Box;
use backend\widgets\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('admin', 'Posts');
$this->params['breadcrumbs'][] = $this->title;

$gridId = 'post-grid';
$gridConfig = [
    'id' => $gridId,
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        'id',
        'title',
        //'alias',
        //'teaser',
        //'text:ntext',
        // 'image',
        [
            'class' => '\backend\widgets\grid\ICheckColumn',
            'attribute' => 'status',
            'modelName' => 'Post',
            'route' => Url::to(['/post/status']),
            'headerOptions' => [
                'style' => 'width: 120px;'
            ]
        ],
        'cnt_view',
        'posted_at:datetime',
        // 'category_id',
        'creator.username',
        // 'editor_id',
        'created_at:datetime',
        // 'updated_at',
    ],
];

$showActions = true;
$actions = [];

if (Yii::$app->user->can('/post/view')) {
    $actions[] = '{view}';
    $showActions = $showActions || true;
}

if (Yii::$app->user->can('/post/update')) {
    $actions[] = '{update}';
    $showActions = $showActions || true;
}

if (Yii::$app->user->can('/post/delete')) {
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

<div class="post-index">

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
