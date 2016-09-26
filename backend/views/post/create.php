<?php

use yii\helpers\Html;
use backend\widgets\Box;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $meta_tag common\models\MetaTag */
/* @var $tags common\models\Tag[] */

$this->title = Yii::t('admin', 'Create Post');
$this->params['breadcrumbs'][] = ['label' => Yii::t('admin', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-create">

    <p>
        <?= Html::a(Yii::t('admin', 'Back to list'), ['index'], ['class' => 'btn btn-flat btn-info']) ?>
    </p>

    <?= $this->render('_form', [
        'model'    => $model,
        'tags'     => $tags,
        'meta_tag' => $meta_tag,
    ]) ?>

</div>
