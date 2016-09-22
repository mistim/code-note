<?php

use yii\helpers\Html;
use yii\helpers\Url;
use backend\widgets\Box;

/**
 * @var yii\web\View $this
 */
$this->title = Yii::t('admin', 'Routes');
$this->params['breadcrumbs'][] = $this->title;
$this->render('/layouts/_sidebar');
?>

    <p>
        <?php echo Html::a(Yii::t('admin', 'Create route'), ['create'], ['class' => 'btn btn-flat btn-success']) ?>
        <?php echo Html::a(Yii::t('admin', 'Update'), ['#'], ['class' => 'btn btn-flat btn-primary', 'id' => 'btn-refresh']); ?>
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

            <div class="col-lg-5">
                <?php echo Html::textInput('search_av', '', [
                        'class'       => 'role-search form-control',
                        'data-target' => 'available',
                        'placeholder' => 'New:'
                    ]) . ' ';
                echo '<br>';
                echo Html::listBox('routes', '', $new, [
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
                        'placeholder' => 'Exists:'
                    ]) . '<br>'; ?>
                <?php echo Html::listBox('routes', '', $exists, [
                    'id'       => 'assigned',
                    'multiple' => true,
                    'size'     => 20,
                    'style'    => 'width:100%',
                    'options'  => $existsOptions,
                    'class'    => 'form-control',
                ]);
                ?>
            </div>

            <?php Box::end(); ?>
        </div>

    </div>
<?php

$this->registerJs("rbac.init({
        name: " . json_encode(isset($name) ? $name : []) . ",
        route: '" . Url::toRoute(['route-search']) . "',
        routeAssign: '" . Url::toRoute(['assign', 'action' => 'assign']) . "',
        routeDelete: '" . Url::toRoute(['assign', 'action' => 'delete']) . "',
        routeSearch: '" . Url::toRoute(['route-search']) . "',
    });", yii\web\View::POS_READY);