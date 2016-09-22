<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;
use backend\widgets\Box;
use backend\widgets\grid\ActionColumn;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\rbac\models\search\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('admin', 'Assignments');
$this->params['breadcrumbs'][] = $this->title;
$this->render('/layouts/_sidebar');

$gridId = 'assignment-grid';
$gridConfig = [
    'id'           => $gridId,
    'dataProvider' => $dataProvider,
    'filterModel'  => $searchModel,
    'columns'      => [
        [
            'attribute'      => 'id',
            'contentOptions' => [
                'width' => '100px'
            ]
        ],
        [
            'class'     => 'yii\grid\DataColumn',
            'attribute' => 'username',
            'label' => Yii::t('admin', 'Username')
        ],
        [
            'class'     => 'yii\grid\DataColumn',
            'attribute' => 'role',
            'value'     => function ($data) {
                $result = [];
                /** @var backend\modules\rbac\models\AuthAssignmentModel $role */
                foreach ($data->roles as $role) {
                    $result[] = $role->item_name;
                }
                return implode(', ', $result);
            },
        ]
    ],
];

$showActions = true;
$actions = ['{view}'];

if ($showActions === true) {
    $gridConfig['columns'][] = [
        'class'          => ActionColumn::className(),
        'template'       => implode(' ', $actions),
        'contentOptions' => [
            'align' => 'center',
            'width' => '100px'
        ]
    ];
}
?>
<div class="assignment-index">

    <?php Pjax::begin(['enablePushState' => false, 'timeout' => 5000]); ?>

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

    <?php Pjax::end(); ?>
</div>
