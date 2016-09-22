<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use backend\widgets\Box;

/**
 * @var yii\web\View $this
 * @var backend\modules\rbac\models\AuthItemModel $model
 */
$this->title = Yii::t('admin', 'View record') . ': ' . $model->name;
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('admin', 'Roles'),
    'url'   => ['index']
];
$this->params['breadcrumbs'][] = $this->title;
$this->render('/layouts/_sidebar');
?>
    <div class="auth-item-view">

        <p>
            <?php echo Html::a(Yii::t('admin', 'Back to list'), ['index'], ['class' => 'btn btn-flat btn-info']); ?>
            <?php echo Html::a(Yii::t('admin', 'Update'), ['update', 'id' => $model->name], ['class' => 'btn btn-flat btn-primary']); ?>
            <?php echo Html::a(Yii::t('admin', 'Delete'), ['delete', 'id' => $model->name], [
                'class'        => 'btn btn-flat btn-danger',
                'data-confirm' => Yii::t('admin', 'Are you sure to delete this item?'),
                'data-method'  => 'post',
            ]);
            ?>
            <?php echo Html::a(Yii::t('admin', 'Create'), ['create'], ['class' => 'btn btn-flat btn-success']); ?>
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

                <div class="col-lg-12">
                    <?php echo DetailView::widget([
                        'model'      => $model,
                        'attributes' => [
                            'name',
                            'description:ntext',
                            'ruleName',
                            'data:ntext',
                        ],
                    ]);
                    ?>
                </div>
                <div class="col-lg-5">
                    <?php echo Html::textInput('search_av', '', [
                            'class'       => 'role-search form-control',
                            'data-target' => 'available',
                            'placeholder' => 'Search:'
                        ]) . '<br>';

                    echo Html::listBox('roles', '', $available, [
                        'id'       => 'available',
                        'multiple' => true,
                        'size'     => 20,
                        'style'    => 'width:100%',
                        'class'    => 'form-control',
                    ]);
                    ?>
                </div>
                <div class="col-lg-2">
                    <div class="move-buttons">
                        <?php echo Html::a('<i class="glyphicon glyphicon-chevron-left"></i>', '#', [
                            'class'       => 'btn btn-flat btn-success',
                            'data-action' => 'delete'
                        ]);

                        ?>
                        <?php echo Html::a('<i class="glyphicon glyphicon-chevron-right"></i>', '#', [
                            'class'       => 'btn btn-flat btn-success',
                            'data-action' => 'assign'
                        ]);
                        ?>
                    </div>
                </div>
                <div class="col-lg-5">
                    <?php echo Html::textInput('search_asgn', '', [
                            'class'       => 'role-search form-control',
                            'data-target' => 'assigned',
                            'placeholder' => 'Search:'
                        ]) . '<br>';

                    echo Html::listBox('roles', '', $assigned, [
                        'id'       => 'assigned',
                        'multiple' => true,
                        'size'     => 20,
                        'style'    => 'width:100%',
                        'class'    => 'form-control',
                    ]);
                    ?>
                </div>

                <?php Box::end(); ?>
            </div>

        </div>
    </div>
<?php

$this->registerJs("rbac.init({
        name: " . json_encode($model->name) . ",
        route: '" . Url::toRoute(['role-search']) . "',
        routeAssign: '" . Url::toRoute(['assign', 'id' => $model->name, 'action' => 'assign']) . "',
        routeDelete: '" . Url::toRoute(['assign', 'id' => $model->name, 'action' => 'delete']) . "',
        routeSearch: '" . Url::toRoute(['route-search']) . "',
    });", yii\web\View::POS_READY);

