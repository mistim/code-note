<?php

use yii\helpers\Html;
use backend\widgets\Box;

/* @var $this yii\web\View */
/* @var $model common\models\Note */
/* @var $meta_tag common\models\MetaTag */

$this->title = Yii::t('admin', 'Update {modelClass}: ', [
    'modelClass' => 'Note',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('admin', 'Notes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('admin', 'Update');
?>
<div class="note-update">

    <p>
        <?= Html::a(Yii::t('admin', 'Back to list'), ['index'], ['class' => 'btn btn-flat btn-info']) ?>
    </p>

    <?= $this->render('_form', [
        'model' => $model,
        'meta_tag' => $meta_tag
    ]) ?>

</div>
