<?php

use yii\helpers\Url;
use yii\grid\GridView;
use backend\widgets\Box;
use backend\widgets\grid\ActionColumn;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\MessageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

Url::remember(Url::current());

$this->title = Yii::t('admin', 'Translations');
$this->params['breadcrumbs'][] = $this->title;

$gridId = 'translate-grid';
$gridConfig = [
    'id' => $gridId,
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'message',
        [
            'attribute' => 'translationEn',
            'label'     => Yii::t('admin', 'EN'),
            'value'     => function ($data) {
                foreach ($data->messages as $item) {
                    if ($item->language === 'en') return $item->translation;
                }
            }
        ],
        [
            'attribute' => 'translationUa',
            'label'     => Yii::t('admin', 'UA'),
            'value'     => function ($data) {
                foreach ($data->messages as $item) {
                    if ($item->language === 'uk') return $item->translation;
                }
            }
        ],
    ],
];

$showActions = false;

if (Yii::$app->user->can('/translation-public/view')) {
    $actions[] = '{view}';
    $showActions = $showActions || true;
}

if (Yii::$app->user->can('/translation-public/update')) {
    $actions[] = '{update}';
    $showActions = $showActions || true;
}

if (Yii::$app->user->can('/translation-public/delete')) {
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

<div class="translation-index">
    <div class="row">
        <div class="col-xs-12 action-panel">
            <div class="pull-left action-inline">
                <?=  Html::a(
                    Yii::t('admin', 'Import'),
                    ['/translation-exchange/import', 'category' => 'app'],
                    [
                        'class'  => 'btn btn-flat btn-success',
                        'target' => '_blank',
                        'data'   => [
                            'method'  => 'post',
                            'confirm' => Yii::t('app', 'The translations will be imported. Are you sure?'),
                        ]
                    ]
                ); ?>
                <?= Html::a(
                    Yii::t('app', 'Export'),
                    ['/translation-exchange/export', 'category' => 'app'],
                    [
                        'class' => 'btn btn-flat btn-info link-prompt-export',
                        'data'  => [
                            'prompt' => 'The translations will be exported. Are you sure?'
                        ],
                    ]
                ); ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <?php Box::begin(
                [
                    'bodyOptions' => [
                        'class' => 'table-responsive'
                    ],
                    'grid'        => $gridId
                ]
            ); ?>
            <?= GridView::widget($gridConfig); ?>
            <?php Box::end(); ?>
        </div>
    </div>
</div>

<?= $this->render('_export');
