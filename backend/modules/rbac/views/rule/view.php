<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\widgets\Box;

/**
 * @var yii\web\View $this
 * @var backend\modules\rbac\models\AuthItemModel $model
 */
$this->title = $model->name;
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('admin', 'BizRules'),
    'url'   => ['index']
];
$this->params['breadcrumbs'][] = $this->title;
$this->render('/layouts/_sidebar');
?>
<div class="auth-item-view">

    <div class="row">
        <div class="col-xs-12">
            <?php Box::begin(
                [
                    'bodyOptions' => [
                        'class' => 'table-responsive'
                    ],
                ]
            ); ?>

            <p>
                <?php echo Html::a(Yii::t('admin', 'Back to list'), ['index'], ['class' => 'btn btn-flat btn-info']); ?>
                <?php echo Html::a('Update', ['update', 'id' => $model->name], ['class' => 'btn btn-flat btn-primary']); ?>
                <?php echo Html::a('Delete', ['delete', 'id' => $model->name], [
                    'class'        => 'btn btn-flat btn-danger',
                    'data-confirm' => Yii::t('admin', 'Are you sure to delete this item?'),
                    'data-method'  => 'post',
                ]);
                ?>
                <?php echo Html::a(Yii::t('admin', 'Create'), ['create'], ['class' => 'btn btn-flat btn-success']); ?>
            </p>

            <?php echo DetailView::widget([
                'model'      => $model,
                'attributes' => [
                    'name',
                    'className',
                    'expression:ntext',
                ],
            ]);
            ?>
            <?php Box::end(); ?>
        </div>
    </div>

</div>

