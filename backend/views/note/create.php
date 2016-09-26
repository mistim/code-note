<?php

use yii\helpers\Html;
use backend\widgets\Box;

/* @var $this yii\web\View */
/* @var $model common\models\Note */
/* @var $meta_tag common\models\MetaTag */
/* @var $tags common\models\Tag[] */

$this->title = Yii::t('admin', 'Create Note');
$this->params['breadcrumbs'][] = ['label' => Yii::t('admin', 'Notes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="note-create">

    <p>
        <?= Html::a(Yii::t('admin', 'Back to list'), ['index'], ['class' => 'btn btn-flat btn-info']) ?>
    </p>

    <?= $this->render('_form', [
        'model'    => $model,
        'tags'     => $tags,
        'meta_tag' => $meta_tag,
    ]) ?>

</div>
