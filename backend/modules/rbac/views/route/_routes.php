<?php
use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

?>

<?php

echo Html::beginForm();
echo GridView::widget([
    'dataProvider' => new ArrayDataProvider([
        'id'        => $type == 1 ? 'new' : 'exists',
        'allModels' => $data
    ]),
    'columns'      => [
        [
            'class'           => 'yii\\grid\\CheckboxColumn',
            'checkboxOptions' => function ($model) use ($type) {
                return [
                    'value'   => ArrayHelper::getValue($model, 'name'),
                    'checked' => $type == 1 ? true : !ArrayHelper::getValue($model, 'exists', false)
                ];
            },
        ],
        [
            'class'          => 'yii\\grid\\DataColumn',
            'attribute'      => 'name',
            'contentOptions' => function ($model) {
                return ArrayHelper::getValue($model, 'exists', true) ? [] : ['style' => 'text-decoration: line-through;'];
            }
        ]
    ]
]);
echo Html::submitButton($type == 1 ? 'Append' : 'Delete', [
    'name'  => 'Submit',
    'value' => $type == 1 ? 'New' : 'Del',
    'class' => 'btn btn-flat btn-primary'
]);
echo Html::endForm();
