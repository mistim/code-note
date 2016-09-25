<?php

use yii\helpers\Html;
use backend\widgets\Box;

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $meta_tag common\models\MetaTag */

$this->title = Yii::t('admin', 'Create Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('admin', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-create">

    <p>
        <?= Html::a(Yii::t('admin', 'Back to list'), ['index'], ['class' => 'btn btn-flat btn-info']) ?>
    </p>

    <?= $this->render('_form', [
        'model' => $model,
        'meta_tag' => $meta_tag
    ]) ?>

</div>
