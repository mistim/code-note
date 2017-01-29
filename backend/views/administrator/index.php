<?php

use yii\helpers\Html;
use backend\widgets\Box;
use backend\widgets\grid\ActionColumn;
use yii\grid\GridView;
use backend\models\User;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('admin', 'Administrator');
$this->params['breadcrumbs'][] = $this->title;

$gridId = 'administrator-grid';
$gridConfig = [
    'id' => $gridId,
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        'id',
        'username',
        'email:email',
        [
            'class' => '\backend\widgets\grid\ICheckColumn',
            'attribute' => 'status',
            'modelName' => 'User',
            'route' => Url::to(['/administrator/status']),
        ],
        [
            'attribute' => 'status',
            'value' => function (User $data) {
                return User::$list_status[$data->status];
            },
            'filter' => User::$list_status
        ],
        [
            'attribute' => 'role',
            'value'     => function (User $data) {
                $result = [];
                /** @var backend\modules\rbac\models\AuthAssignmentModel $role */
                foreach ($data->roles as $role) {
                    $result[] = $role->item_name;
                }
                return implode(', ', $result);
            }
        ],
        'last_enter:datetime'
        // 'created_at',
        // 'updated_at',
    ],
];

$showActions = true;
$actions = [];

if (Yii::$app->user->can('/administrator/view')) {
    $actions[] = '{view}';
    $showActions = $showActions || true;
}

if (Yii::$app->user->can('/administrator/update')) {
    $actions[] = '{update}';
    $showActions = $showActions || true;
}

if (Yii::$app->user->can('/administrator/delete')) {
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

<div class="administrator-index">

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
