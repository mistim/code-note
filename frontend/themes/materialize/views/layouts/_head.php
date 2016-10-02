<?php

use yii\helpers\Html;
use frontend\assets as Assets;

/* @var $this \yii\web\View */

?>

<meta charset="<?= Yii::$app->charset ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?= Html::csrfMetaTags() ?>
<title><?= Html::encode($this->params['title']) ?></title>
<meta name="keywords" content="<?= Html::encode($this->params['keywords']) ?>" />
<meta name="description" content="<?= Html::encode($this->params['description']) ?>" />
<?php $this->head() ?>

<?php
Assets\MaterializeAsset::register($this);
Assets\HighlightAsset::register($this);
Assets\AppAsset::register($this);
