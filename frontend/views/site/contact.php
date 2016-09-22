<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
    </p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin([
                'id' => 'contact-form',
                'fieldConfig' => [
                    'options' => [
                        'tag'=>'div'
                    ],
                    'template' => '<div class="input-field col s12">{input}{label}{error}</div>'
                ],
            ]); ?>

                <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'subject') ?>

                <?= $form->field($model, 'body')->textarea(['rows' => 6, 'class' => 'materialize-textarea']) ?>

                <?= $form->field($model, 'verifyCode', [
                    'template' => '{input}{error}',
                    'labelOptions' => ['class' => 'col s9 offset-s3'],
                    'errorOptions' => ['class' => 'col s9 offset-s3'],
                ])->widget(Captcha::className(), [
                    'template' => '<div>'.
                        '<div class="input-field col s3">{image}</div>'.
                        '<div class="input-field col s9">{input}'.
                        '<label for="contactform-verifycode">Verification Code</label>'.
                        '</div>'.
                        '</div>',
                ]) ?>

                <div class="input-field col s2">
                    <?= Html::submitButton('Submit', ['class' => 'btn waves-effect waves-light', 'name' => 'contact-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
