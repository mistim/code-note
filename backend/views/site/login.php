<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \backend\models\form\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use backend\widgets\Alert;

$this->title = Yii::t('admin', 'Authorization');
$this->params['breadcrumbs'][] = $this->title;

$this->context->layout = '/guest';
?>
<div class="row" style="height: 100%; padding-top: 100px;">
    <div class="col-md-4 col-md-offset-4">

        <?php
        $errorLdap = Yii::$app->session->get('errorLdap');
        if ($errorLdap)
        {
            Yii::$app->session->setFlash('error', $errorLdap);
        }
        ?>
        <?= Alert::widget(); ?>

        <div class="login-logo">
            <span class="amanat-logo"></span>
            <span class="amanat-project"><?= Yii::t('admin', 'Control Panel') ?></span>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading text-center">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
            </div>
            <div class="panel-body">

                <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'layout' => 'horizontal',
                    'fieldConfig' => [
                        'horizontalCssClasses' => [
                            'label'   => 'col-sm-3',
                            'offset'  => 'col-sm-offset-3',
                            'wrapper' => 'col-sm-9',
                        ],
                    ],
                ]); ?>

                <?= $form->field($model, 'username', [
                    'inputTemplate' => '<div class="input-group">{input}<span class="input-group-addon"><i class="fa fa-user"></i></span></span></div>'
                ]) ?>

                <?= $form->field($model, 'password', [
                    'inputTemplate' => '<div class="input-group">{input}<span class="input-group-addon"><i class="fa fa-lock"></i></span></span></div>'
                ])->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <div class="col-sm-offset-3 col-sm-6">
                    <?= Html::submitButton(Yii::t('app', 'Sign in'), [
                        'class' => 'btn btn-success btn-flat btn-block'
                    ]) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>
