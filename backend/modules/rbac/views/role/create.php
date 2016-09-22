<?php

use yii\helpers\Html;
use backend\widgets\Box;

/**
 * @var yii\web\View $this
 * @var backend\modules\rbac\models\AuthItemModel $model
 */

$this->title = Yii::t('admin', 'Create record');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('admin', 'Roles'),
    'url'   => ['index']
];
$this->params['breadcrumbs'][] = $this->title;
$this->render('/layouts/_sidebar');
?>
<div class="auth-item-create">

    <p>
        <?php echo Html::a(Yii::t('admin', 'Back to list'), ['index'], ['class' => 'btn btn-flat btn-info']); ?>
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
            <?php echo $this->render('_form', [
                'model' => $model,
            ]);
            ?>
            <?php Box::end(); ?>
        </div>
    </div>

</div>
